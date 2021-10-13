<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Mountains Model
 *
 * @method \App\Model\Entity\Mountain newEmptyEntity()
 * @method \App\Model\Entity\Mountain newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Mountain[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Mountain get($primaryKey, $options = [])
 * @method \App\Model\Entity\Mountain findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Mountain patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Mountain[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Mountain|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mountain saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mountain[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Mountain[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Mountain[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Mountain[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MountainsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('mountains');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->allowEmptyString('id', null, 'create');

        $validator
            ->nonNegativeInteger('mountain_no')
            ->requirePresence('mountain_no', 'create')
            ->notEmptyString('mountain_no');

        $validator
            ->scalar('mountain_name')
            ->maxLength('mountain_name', 255)
            ->requirePresence('mountain_name', 'create')
            ->notEmptyString('mountain_name');

        $validator
            ->scalar('area')
            ->maxLength('area', 20)
            ->requirePresence('area', 'create')
            ->notEmptyString('area');

        $validator
            ->scalar('elevation')
            ->maxLength('elevation', 20)
            ->requirePresence('elevation', 'create')
            ->notEmptyString('elevation');

        $validator
            ->scalar('difficulty_level')
            ->maxLength('difficulty_level', 20)
            ->allowEmptyString('difficulty_level');

        $validator
            ->scalar('physical_level')
            ->maxLength('physical_level', 20)
            ->allowEmptyString('physical_level');

        $validator
            ->integer('schedule_type')
            ->allowEmptyString('schedule_type');

        $validator
            ->scalar('active_volcano')
            ->maxLength('active_volcano', 20)
            ->allowEmptyString('active_volcano');

        $validator
            ->scalar('snow_season')
            ->maxLength('snow_season', 20)
            ->allowEmptyString('snow_season');

        $validator
            ->scalar('remaining_snow_season')
            ->maxLength('remaining_snow_season', 20)
            ->allowEmptyString('remaining_snow_season');

        $validator
            ->scalar('climbing_season_type')
            ->maxLength('climbing_season_type', 20)
            ->allowEmptyString('climbing_season_type');

        $validator
            ->scalar('autumn_season_type')
            ->maxLength('autumn_season_type', 20)
            ->allowEmptyString('autumn_season_type');

        $validator
            ->allowEmptyString('created_by');

        $validator
            ->allowEmptyString('modified_by');

        return $validator;
    }
}
