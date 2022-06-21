--  For every department, display the average course credit of the department and the 
--  overall average of the course credits (i.e., the average credit over all courses, not
-- within a department). Your answer should consist of three columns 
-- (dept, dept_avg_course_credit, overall_avg_course_credit).
-- In your answer, return one tuple per each department.

SELECT DISTINCT dept,
       AVG(credits) OVER(PARTITION BY dept) AS dept_avg_course_credit,
       AVG(credits) OVER() AS overall_avg_course_credit
FROM Class;
