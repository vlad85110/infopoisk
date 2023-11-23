from django.db import models
from django.db.models import Model

# Create your models here.

class University(models.Model):
    full_name = models.CharField(max_length=100)
    short_name = models.CharField(max_length=50)
    creation_date = models.DateField()

    def __str__(self):
        return self.short_name

class Student(models.Model):
    full_name = models.CharField(max_length=100)
    birth_date = models.DateField()
    university = models.ForeignKey(University, on_delete=models.PROTECT)
    enrollment_year = models.IntegerField(default=0)

    def __str__(self):
        return self.full_name