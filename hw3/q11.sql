SELECT id
FROM Student
FULL OUTER JOIN Takes
ON Student.id = Takes.stud_id;