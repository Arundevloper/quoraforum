// Assuming you have a database connection established

// Fetch the answers from the database and sort them
$query = "SELECT a.answer, a.likes, a.dislikes, a.timestamp, likes/(likes+dislikes) as ratio, u.username, c.category_name, t.tag_name
          FROM answers AS a
          JOIN users AS u ON a.user_id = u.id
          JOIN categories AS c ON a.category_id = c.id
          JOIN tags AS t ON a.tag_id = t.id
          ORDER BY ratio DESC, a.timestamp DESC";
$result = mysqli_query($connection, $query);

// Print the sorted answers
while ($row = mysqli_fetch_assoc($result)) {
    echo 'Answer: ' . $row['answer'] . "\n";
    echo 'Likes: ' . $row['likes'] . "\n";
    echo 'Dislikes: ' . $row['dislikes'] . "\n";
    echo 'Like-to-Dislike Ratio: ' . $row['ratio'] . "\n";
    echo 'Timestamp: ' . $row['timestamp'] . "\n";
    echo 'Username: ' . $row['username'] . "\n";
    echo 'Category: ' . $row['category_name'] . "\n";
    echo 'Tag: ' . $row['tag_name'] . "\n\n";
}


$query = "SELECT a.ansImg, a.ans_id, u.userName AS aUserName, u.userImage, q.userName AS qUserName, q.post, q.question, a.answer, a.ansImg, a.DT,
          COUNT(l.likeid) AS likecount, COUNT(d.dislikeid) AS dislikecount,
          COUNT(l.likeid) / COUNT(d.dislikeid) AS ratio
          FROM questions AS q
          INNER JOIN answer AS a ON q.ques_id = $questionId AND a.ques_id = $questionId
          INNER JOIN users_info AS u ON a.userName = u.userName
          LEFT JOIN likes AS l ON a.ans_id = l.ans_id
          LEFT JOIN dislikes AS d ON a.ans_id = d.ans_id
          GROUP BY a.ans_id
          ORDER BY ratio DESC, a.DT DESC";
$result = mysqli_query($connection, $query);

// Print the sorted results
while ($row = mysqli_fetch_assoc($result)) {
    echo 'Answer ID: ' . $row['ans_id'] . "\n";
    echo 'Question: ' . $row['question'] . "\n";
    echo 'Question Post: ' . $row['post'] . "\n";
    echo 'Answer: ' . $row['answer'] . "\n";
    echo 'Answer Image: ' . $row['ansImg'] . "\n";
    echo 'Answer Timestamp: ' . $row['DT'] . "\n";
    echo 'Question User Name: ' . $row['qUserName'] . "\n";
    echo 'Answer User Name: ' . $row['aUserName'] . "\n";
    echo 'Answer User Image: ' . $row['userImage'] . "\n";
    echo 'Likes: ' . $row['like_count'] . "\n";
    echo 'Dislikes: ' . $row['dislike_count'] . "\n";
    echo 'Like-to-Dislike Ratio: ' . $row['ratio'] . "\n\n";
}


SELECT a.ansImg, a.ans_id, u.userName AS aUserName, u.userImage, q.userName AS qUserName, q.post, q.question, a.answer, a.ansImg, a.DT,
          COUNT(l.likeid) AS likecount, COUNT(d.dislike_id) AS dislikecount,
          COUNT(l.likeid) / COUNT(d.dislike_id) AS ratio
          FROM questions AS q
          INNER JOIN answer AS a ON q.ques_id = 7 AND a.ques_id =7
          INNER JOIN users_info AS u ON a.userName = u.userName
          LEFT JOIN likes AS l ON a.ans_id = l.ans_id
          LEFT JOIN dislikes AS d ON a.ans_id = d.ans_id
          GROUP BY a.ans_id
          ORDER BY ratio DESC, a.DT DESC;