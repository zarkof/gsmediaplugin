<?php


/**
 * This class adds structure of 'gs_media_folder' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Wed Feb 11 16:47:44 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    plugins.gsMediaPlugin.lib.model.map
 */
class gsMediaFolderMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.gsMediaPlugin.lib.model.map.gsMediaFolderMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(gsMediaFolderPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(gsMediaFolderPeer::TABLE_NAME);
		$tMap->setPhpName('gsMediaFolder');
		$tMap->setClassname('gsMediaFolder');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null);

		$tMap->addColumn('RELATIVE_PATH', 'RelativePath', 'VARCHAR', true, 255);

		$tMap->addForeignKey('TREE_PARENT', 'TreeParent', 'INTEGER', 'gs_media_folder', 'ID', false, null);

		$tMap->addColumn('TREE_LEFT', 'TreeLeft', 'INTEGER', false, null);

		$tMap->addColumn('TREE_RIGHT', 'TreeRight', 'INTEGER', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} // doBuild()

} // gsMediaFolderMapBuilder
