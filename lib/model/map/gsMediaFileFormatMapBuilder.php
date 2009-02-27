<?php


/**
 * This class adds structure of 'gs_media_file_format' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Thu Feb 26 15:28:13 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    plugins.gsMediaPlugin.lib.model.map
 */
class gsMediaFileFormatMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.gsMediaPlugin.lib.model.map.gsMediaFileFormatMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(gsMediaFileFormatPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(gsMediaFileFormatPeer::TABLE_NAME);
		$tMap->setPhpName('gsMediaFileFormat');
		$tMap->setClassname('gsMediaFileFormat');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('FILE_ID', 'FileId', 'INTEGER', 'gs_media_file', 'ID', true, null);

		$tMap->addForeignKey('FORMAT_ID', 'FormatId', 'INTEGER', 'gs_media_format', 'ID', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

	} // doBuild()

} // gsMediaFileFormatMapBuilder