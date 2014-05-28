ALTER TABLE `posts_link` ALTER is_up SET DEFAULT 1;
DELIMITER $$
CREATE TRIGGER update_vote_count BEFORE INSERT ON `posts_link`
	FOR EACH ROW 
        BEGIN
		IF (NEW.is_up = 1) THEN
			UPDATE posts SET up = up + 1 WHERE id = NEW.post_id;
		ELSE
			UPDATE posts SET down = down + 1 WHERE id = NEW.post_id;
		END IF;
	END$$
DELIMITER ;
