<?php
class Comments 
{
	public static function addComment($userid, $picid, $albumid, $content) {
		mb_internal_encoding('UTF-8');
	
		$comment = trim($content);
	
		if (empty($comment)) {
			$_SESSION['error'] = "You can not add empty comment!";
		} else {
			mysqli_query($GLOBALS['mysqli'], 'INSERT INTO comments (userid, picid, albumid, content) VALUES (' . $userid . ', ' . $picid . ', ' . $albumid . ', "' . $comment . '")') or die(mysqli_error($GLOBALS['mysqli']));
		}
	}
	
	public static function getAllCommentsByPicId($picid) {
		$results = mysqli_query($GLOBALS['mysqli'], "Select * FROM comments WHERE picid=$picid") or die(mysqli_error($GLOBALS['mysqli']));

        $query = "Select * FROM comments WHERE picid=$picid";
        $result = $GLOBALS['mysqli'] -> query($query) or die(mysqli_error($GLOBALS['mysqli']));

        $comments = [];
        if ($result->num_rows > 0) {
            while ($row = $result -> fetch_assoc()) {
                $comments[] = $row;
            }
        } else {
        	return false;
        }
        return $comments;
    }
}
 ?>
