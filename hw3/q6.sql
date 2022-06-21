--As above, but display the average course credit per every department.
--Your answer should consist of two columns (dept, dept_average_course_credit) and every department should appear once in your result.

SELECT dept, AVG(credits) AS dept_average_course_credit
FROM Class 
GROUP BY dept;