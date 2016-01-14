requete SQL pour avoir tous les jeux et une propriétaire:
SELECT * FROM games
WHERE owner_user_id IN (SELECT id FROM users
						WHERE created_at > SUBDATE(CURRENT_DATE,1));


// expresion régulières

