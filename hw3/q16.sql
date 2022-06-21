WITH RECURSIVE Recursion AS 
(
SELECT prereq_id
FROM Prereq
WHERE class_id="BIO-399"
UNION ALL    
SELECT child.prereq_id
FROM Prereq as child
JOIN Recursion AS parent on parent.prereq_id = child.class_id
)
SELECT *
FROM Recursion;