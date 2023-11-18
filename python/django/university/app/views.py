from django.shortcuts import render, redirect, get_object_or_404
from .models import University, Student
from .forms import UniversityForm, StudentForm


def index(request):
    return render(request, 'index.html')


def students_list(request):
    students = Student.objects.all()
    return render(request, 'students.html', {'students': students})


def universities_list(request):
    universities = University.objects.all()
    return render(request, 'universities.html', {'universities': universities})


def create_university(request):
    if request.method == 'POST':
        form = UniversityForm(request.POST)
        if form.is_valid():
            form.save()
            return redirect('universities')
    else:
        form = UniversityForm()
    return render(request, 'create_university.html', {'form': form})


def create_student(request):
    if request.method == 'POST':
        form = StudentForm(request.POST)
        if form.is_valid():
            form.save()
            return redirect('students')
    else:
        form = StudentForm()
    return render(request, 'create_student.html', {'form': form})


def delete_university(request, university_id):
    university = get_object_or_404(University, pk=university_id)
    if request.method == 'POST':
        university.delete()
        return redirect('universities')
    return render(request, 'delete_university.html', {'university': university})


def delete_student(request, student_id):
    student = get_object_or_404(Student, pk=student_id)
    if request.method == 'POST':
        student.delete()
        return redirect('students')
    return render(request, 'delete_student.html', {'student': student})    


def edit_university(request, university_id):
    university = get_object_or_404(University, pk=university_id)
    if request.method == 'POST':
        form = UniversityForm(request.POST, instance=university)
        if form.is_valid():
            form.save()
            return redirect('universities')
    else:
        form = UniversityForm(instance=university)
    return render(request, 'edit_university.html', {'form': form, 'university': university})


def edit_student(request, student_id):
    student = get_object_or_404(Student, pk=student_id)
    if request.method == 'POST':
        form = StudentForm(request.POST, instance=student)
        if form.is_valid():
            form.save()
            return redirect('students')
    else:
        form = StudentForm(instance=student)
    return render(request, 'edit_student.html', {'form': form, 'student': student})    