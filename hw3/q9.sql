-- ‘Comp. Sci.’ and ‘Elec. Eng.’ departments belong to ‘Engineering’ school
--  and all other departments belong to ‘L&S’ (letter and science) school. 
--  For every department, return the school they belong to. 
--  Your answer must consist of two columns (dept, school).

SELECT dept,
    CASE
    WHEN dept = "Comp. Sci." THEN "Engineering"
    WHEN dept = "Elec. Eng." THEN "Engineering"
    ELSE "L&S"
    END AS school
FROM Department; 