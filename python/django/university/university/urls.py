"""
URL configuration for university project.

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/4.2/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.contrib import admin
from django.urls import path
from app.views import *


urlpatterns = [
    path('', index),
    path('students', students_list, name='students'),
    path('universities', universities_list, name='universities'),
    path('create_university', create_university, name='create_university'),
    path('create_student', create_student, name='create_student'),
    path('delete_university/<int:university_id>/', delete_university, name='delete_university'),
    path('delete_student/<int:student_id>/', delete_student, name='delete_student'),
    path('edit_university/<int:university_id>/', edit_university, name='edit_university'),
    path('edit_student/<int:student_id>/', edit_student, name='edit_student'),

    path('admin/', admin.site.urls),
]
