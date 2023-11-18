from django import forms
from .models import Student, University


class UniversityForm(forms.ModelForm):
    class Meta:
        model = University
        fields = ['full_name', 'short_name', 'creation_date']
        widgets = {
            'creation_date': forms.DateInput(attrs={'type': 'date'}),
        }


class StudentForm(forms.ModelForm):
    class Meta:
        model = Student
        fields = ['full_name', 'birth_date', 'university', 'enrollment_year']
        widgets = {
            'birth_date': forms.DateInput(attrs={'type': 'date'}),
            'enrollment_year': forms.Select(choices=[(year, year) for year in range(2000, 2031)]),
        }        