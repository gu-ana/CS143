SELECT COUNT(DISTINCT awardYear)
FROM Prize
WHERE id IN (SELECT id FROM Org);
