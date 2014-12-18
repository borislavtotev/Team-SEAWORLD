<?php
class Comments 
{
	public static function addComment($userid, $picid, $albumid, $content) {
		mb_internal_encoding('UTF-8');
	
		$comment = trim($content);
		
		$query = 'INSERT INTO `comments` (`userid`, `picid`, `albumid`, `content`) VALUES (' . $userid . ', ' . $picid . ', ' . $albumid . ', "' . $comment . '")';
		
		if (is_null($picid)) {
			$query = 'INSERT INTO `comments` (`userid`, `albumid`, `content`) VALUES (' . $userid . ', ' . $albumid . ', "' . $comment . '")';
		}
		
		if (empty($comment)) {
			$_SESSION['error'] = "You can not add empty comment!";
		} else {
			mysqli_query($GLOBALS['mysqli'],$query) or die(mysqli_error($GLOBALS['mysqli']));
		}
	}
	
	public static function getAllCommentsByPicId($picid) {
        $query = "Select * FROM `comments` WHERE `picid`='$picid'";
        $result = $GLOBALS['mysqli'] -> query($query) or die(mysqli_error($GLOBALS['mysqli']));

        $comments = [];
        if ($result->num_rows > 0) {
            while ($row = $result -> fetch_assoc()) {
                $comments[] = $row;
            }
        } else {
        	return [];
        }
        return $comments;
    }
	
	public static function getAllCommentsByAlbumId($albumid) {
        $query = "Select * FROM `comments` WHERE `albumid`='$albumid'";
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
	
	public static function countPicComments($picid) {
		$results = Comments::getAllCommentsByPicId($picid);
		
		if ($results == false) {
			return 0;
		} else {
			return count($results);
		}	
			
	}
	public static function countAlbumComments ($albumid) {
		$results = Comments::getAllCommentsByAlbumId($albumid);
		
		if ($results == false) {
			return 0;
		} else {
			return count($results);
		}		
	}
	public static function getOwnerId ($commentid) {
        $query = "Select userid FROM comments WHERE commentid=$commentid";
        $result = $GLOBALS['mysqli'] -> query($query) or die(mysqli_error($GLOBALS['mysqli']));
		
        $userid = null;
        if ($result->num_rows > 0) {
            while ($row = $result -> fetch_assoc()) {
                $userid = $row['userid'];
            }
        } else {
        	return false;
        }

        return $userid;		
	}
	public static function remove ($commentid) {
        $query = "DELETE FROM comments WHERE commentid=$commentid";
        $GLOBALS['mysqli'] -> query($query) or die(mysqli_error($GLOBALS['mysqli']));	
	}

}
 ?>
