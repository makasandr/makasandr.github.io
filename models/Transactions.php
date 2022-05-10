<?php

class Transactions
{
	public static function addSome($data)
	{
		$db = Db::getConnection();
		$sql = 'INSERT INTO transactions (student, trainer, amount, program, date) VALUES (:student, :trainer, :amount, :program, '.time().')';

		$result = $db->prepare($sql);
		$result->bindParam(':student', $data['student'], PDO::PARAM_INT);
		$result->bindParam(':trainer', $data['trainer'], PDO::PARAM_INT);
		$result->bindParam(':amount', $data['amount'], PDO::PARAM_STR);
		$result->bindParam(':program', $data['program'], PDO::PARAM_INT);
		if ($result->execute()) return true;
		return false;
	}

	public static function getStudentTotal($from, $to, $id)
	{
		$db = Db::getConnection();
		$sql = 'SELECT amount FROM transactions WHERE student = :student AND date > '.$from.' AND date < '.$to;

		$result = $db->prepare($sql);
		$result->bindParam(':student', $id, PDO::PARAM_INT);
		$result->execute();

		$total = 0;
		while ($row = $result->fetch()) {
			$total += floatval($row['amount']);
		}
		
		return $total;
	}

	public static function getTrainerTotal($from, $to, $id)
	{
		$db = Db::getConnection();
		$sql = 'SELECT amount FROM transactions WHERE trainer = :trainer AND date > '.$from.' AND date < '.$to;

		$result = $db->prepare($sql);
		$result->bindParam(':trainer', $id, PDO::PARAM_INT);
		$result->execute();

		$total = 0;
		while ($row = $result->fetch()) {
			$total += floatval($row['amount']);
		}
		
		return $total;
	}

	public static function getStudentTotalNum($id)
	{
		$db = Db::getConnection();
		$sql = 'SELECT COUNT(id) FROM transactions WHERE student = :student AND program <> 0';

		$result = $db->prepare($sql);
		$result->bindParam(':student', $id, PDO::PARAM_INT);
		$result->execute();

		$total = 0;
		$row = $result->fetch();
		
		return $row[0];
	}

	public static function getTrainerTotalNum($id)
	{
		$db = Db::getConnection();
		$sql = 'SELECT COUNT(id) FROM transactions WHERE trainer = :trainer AND program <> 0';

		$result = $db->prepare($sql);
		$result->bindParam(':trainer', $id, PDO::PARAM_INT);
		$result->execute();

		$total = 0;
		$row = $result->fetch();
		
		return $row[0];
	}

	public static function getStudentTotalPrivate($id)
	{
		$db = Db::getConnection();
		$sql = 'SELECT amount FROM transactions WHERE student = :student AND program = 0';

		$result = $db->prepare($sql);
		$result->bindParam(':student', $id, PDO::PARAM_INT);
		$result->execute();

		$total = 0;
		while ($row = $result->fetch()) {
			$total += floatval($row['amount']);
		}
		
		return $total;
	}

	public static function getTrainerTotalPrivate($id)
	{
		$db = Db::getConnection();
		$sql = 'SELECT amount FROM transactions WHERE trainer = :trainer AND program = 0';

		$result = $db->prepare($sql);
		$result->bindParam(':trainer', $id, PDO::PARAM_INT);
		$result->execute();

		$total = 0;
		while ($row = $result->fetch()) {
			$total += floatval($row['amount']);
		}
		
		return $total;
	}

	public static function getStudentTotalCommon($id)
	{
		$db = Db::getConnection();
		$sql = 'SELECT amount FROM transactions WHERE student = :student AND program <> 0';

		$result = $db->prepare($sql);
		$result->bindParam(':student', $id, PDO::PARAM_INT);
		$result->execute();

		$total = 0;
		while ($row = $result->fetch()) {
			$total += floatval($row['amount']);
		}
		
		return $total;
	}

	public static function getTrainerTotalCommon($id)
	{
		$db = Db::getConnection();
		$sql = 'SELECT amount FROM transactions WHERE trainer = :trainer AND program <> 0';

		$result = $db->prepare($sql);
		$result->bindParam(':trainer', $id, PDO::PARAM_INT);
		$result->execute();

		$total = 0;
		while ($row = $result->fetch()) {
			$total += floatval($row['amount']);
		}
		
		return $total;
	}

	public static function getStudentTotalPrivateNum($id)
	{
		$db = Db::getConnection();
		$sql = 'SELECT COUNT(id) FROM transactions WHERE student = :student AND program = 0';

		$result = $db->prepare($sql);
		$result->bindParam(':student', $id, PDO::PARAM_INT);
		$result->execute();

		$total = 0;
		$row = $result->fetch();
		
		return $row[0];
	}

	public static function getTrainerTotalPrivateNum($id)
	{
		$db = Db::getConnection();
		$sql = 'SELECT COUNT(id) FROM transactions WHERE trainer = :trainer AND program = 0';

		$result = $db->prepare($sql);
		$result->bindParam(':trainer', $id, PDO::PARAM_INT);
		$result->execute();

		$total = 0;
		$row = $result->fetch();
		
		return $row[0];
	}
}