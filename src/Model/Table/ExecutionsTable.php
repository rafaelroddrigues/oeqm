<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Executions Model
 *
 * @property \App\Model\Table\TestCasesTable|\Cake\ORM\Association\BelongsTo $TestCases
 * @property \App\Model\Table\BugsTable|\Cake\ORM\Association\BelongsTo $Bugs
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\PhasesTable|\Cake\ORM\Association\BelongsTo $Phases
 *
 * @method \App\Model\Entity\Execution get($primaryKey, $options = [])
 * @method \App\Model\Entity\Execution newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Execution[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Execution|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Execution patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Execution[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Execution findOrCreate($search, callable $callback = null, $options = [])
 */
class ExecutionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('executions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('TestCases', [
            'foreignKey' => 'test_cases_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'users_id'
        ]);
        $this->belongsTo('Phases', [
            'foreignKey' => 'phases_id'
        ]);
        $this->belongsTo('Projects', [
            'foreignKey' => 'projects_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('status')
            ->allowEmpty('status');

	$validator->notEmpty('test_cases_id');
	$validator->notEmpty('phases_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['test_cases_id'], 'TestCases'));
        $rules->add($rules->existsIn(['users_id'], 'Users'));
        $rules->add($rules->existsIn(['phases_id'], 'Phases'));
	$rules->add($rules->isUnique(['test_cases_id','phases_id']));

        return $rules;
    }
}
