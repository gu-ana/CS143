-- For each school (i.e., Engineering or L&S), show the number of students and
--  the number of instructors in the school. 
--  Your answer must consist of three columns (school, num_studs, num_insts).
WITH School AS 
(SELECT dept,
CASE
    WHEN dept = "Comp. Sci." THEN "Engineering"
    WHEN dept = "Elec. Eng." THEN "Engineering"
    ELSE "L&S"
END AS school
FROM Department)
SELECT school, count(distinct Student.id), COUNT(DISTINCT Instructor.id)
FROM School, Student, Instructor
WHERE Student.dept=School.dept and Student.dept = Instructor.dept
GROUP BY school;
