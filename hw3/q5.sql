--Return the average credit of the courses that are offered by the ‘Comp. Sci.’ department.

SELECT AVG(credits) 
FROM Class
WHERE dept = "Comp. Sci.";