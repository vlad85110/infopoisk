from flask import Flask, render_template, request, redirect, url_for, flash
from flask_sqlalchemy import SQLAlchemy
from flask_login import LoginManager, UserMixin, login_user, login_required, logout_user, current_user
from flask_wtf import FlaskForm
from wtforms import StringField, PasswordField, SubmitField
from wtforms.validators import DataRequired, Length
from werkzeug.security import generate_password_hash, check_password_hash
from datetime import datetime


app = Flask(__name__)
app.config['SECRET_KEY'] = 'your_secret_key'
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///site.db'
db = SQLAlchemy(app)
login_manager = LoginManager(app)
login_manager.login_view = 'login'


class User(UserMixin, db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(20), unique=True, nullable=False)
    password = db.Column(db.String(60), nullable=False)


@login_manager.user_loader
def load_user(user_id):
    return User.query.get(int(user_id))


class University(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    full_name = db.Column(db.String(100), nullable=False)
    short_name = db.Column(db.String(50), nullable=False)
    created_date = db.Column(db.DateTime, default=datetime.utcnow)


class Student(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    full_name = db.Column(db.String(100), nullable=False)
    birth_date = db.Column(db.Date, nullable=False)
    university_id = db.Column(db.Integer, db.ForeignKey('university.id'), nullable=False)
    university = db.relationship('University', backref=db.backref('students', lazy=True))
    admission_year = db.Column(db.Integer, nullable=False)


class RegistrationForm(FlaskForm):
    username = StringField('Username', validators=[DataRequired(), Length(min=2, max=20)])
    password = PasswordField('Password', validators=[DataRequired()])
    submit = SubmitField('Sign Up')


class LoginForm(FlaskForm):
    username = StringField('Username', validators=[DataRequired(), Length(min=2, max=20)])
    password = PasswordField('Password', validators=[DataRequired()])
    submit = SubmitField('Log In')


@app.before_request
def before_request():
    if not current_user.is_authenticated and request.endpoint not in ['login', 'register']:
        return redirect(url_for('login'))

@app.route('/')
def index():
    universities = University.query.all()
    students = Student.query.all()
    return render_template('index.html', universities=universities, students=students)


@app.route('/add_university', methods=['POST'])
@login_required
def add_university():
    full_name = request.form['full_name']
    short_name = request.form['short_name']
    university = University(full_name=full_name, short_name=short_name)
    db.session.add(university)
    db.session.commit()
    return redirect(url_for('index'))


@app.route('/add_student', methods=['POST'])
@login_required
def add_student():
    full_name = request.form['full_name']
    birth_date = datetime.strptime(request.form['birth_date'], '%Y-%m-%d').date()
    university_id = request.form['university']
    admission_year = int(request.form['admission_year'])
    student = Student(full_name=full_name, birth_date=birth_date, university_id=university_id,
                      admission_year=admission_year)
    db.session.add(student)
    db.session.commit()
    return redirect(url_for('index'))


@app.route('/edit_university/<int:id>', methods=['GET', 'POST'])
@login_required
def edit_university(id):
    university = University.query.get(id)
    if request.method == 'POST':
        university.full_name = request.form['full_name']
        university.short_name = request.form['short_name']
        db.session.commit()
        return redirect(url_for('index'))
    return render_template('edit_university.html', university=university)


@app.route('/delete_university/<int:id>')
@login_required
def delete_university(id):
    university = University.query.get(id)
    if university.students:
        flash('Cannot delete the university with associated students. Delete the students first.', 'danger')
    else:
        db.session.delete(university)
        db.session.commit()
        flash('University deleted successfully.', 'success')
    return redirect(url_for('index'))


@app.route('/edit_student/<int:id>', methods=['GET', 'POST'])
@login_required
def edit_student(id):
    student = Student.query.get(id)
    universities = University.query.all()
    if request.method == 'POST':
        student.full_name = request.form['full_name']
        student.birth_date = datetime.strptime(request.form['birth_date'], '%Y-%m-%d').date()
        student.university_id = request.form['university']
        student.admission_year = int(request.form['admission_year'])
        db.session.commit()
        return redirect(url_for('index'))
    return render_template('edit_student.html', student=student, universities=universities)


@app.route('/delete_student/<int:id>')
@login_required
def delete_student(id):
    student = Student.query.get(id)
    db.session.delete(student)
    db.session.commit()
    return redirect(url_for('index'))


@app.route('/login', methods=['GET', 'POST'])
def login():
    form = LoginForm()
    if form.validate_on_submit():
        user = User.query.filter_by(username=form.username.data).first()
        if user and check_password_hash(user.password, form.password.data):
            login_user(user, remember=True)
            flash('Login successful!', 'success')
            return redirect(url_for('index'))
        else:
            flash('Login unsuccessful. Please check username and password', 'danger')
    return render_template('login.html', form=form)


@app.route('/register', methods=['GET', 'POST'])
def register():
    form = RegistrationForm()
    if form.validate_on_submit():
        user = User.query.filter_by(username=form.username.data).first()

        if user != None:
            flash('This user already exists', 'warning')
            return render_template('register.html', form=form)

        hashed_password = generate_password_hash(form.password.data, method='pbkdf2:sha256')
        new_user = User(username=form.username.data, password=hashed_password)
        db.session.add(new_user)
        db.session.commit()
        flash('Your account has been created! You are now logged in.', 'success')
        login_user(new_user, remember=True)
        return redirect(url_for('index'))
    return render_template('register.html', form=form)


@app.route('/logout')
@login_required
def logout():
    logout_user()
    return redirect(url_for('index'))


if __name__ == '__main__':
    with app.app_context():
        db.create_all()
    app.run(debug=True)
