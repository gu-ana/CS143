SELECT dept, MAX(credits) 
FROM Class
GROUP BY dept;