-- Compute the average salary of all instructors and compare it 
-- against the average instructor salary within each department. 
-- Your answer must consist of two columns (dept, diff_avg_salary), 
-- where dept is a department name and diff_avg_salary is 
-- avg(all instructor salaries) - avg(the department’s instructors’ salaries). 
-- In your answer, return one tuple per each department.

SELECT DISTINCT dept,
       (AVG(salary) OVER() - AVG(salary) OVER(PARTITION BY dept)) AS  diff_avg_salary
       FROM Instructor;