--Find the names of departments that offer only 3-credit classes.

SELECT dept
FROM Class
EXCEPT 
(SELECT dept 
FROM Class 
WHERE credits = 3);