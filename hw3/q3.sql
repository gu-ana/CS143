--Return the department names that offer at least three classes.

SELECT dept
FROM Class 
GROUP BY dept 
HAVING COUNT(*) > 2;