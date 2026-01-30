<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/** 
 * Deposits Model
 *
 * @property \App\Model\Table\CostCentersTable&\Cake\ORM\Association\BelongsTo $CostCenters
 * @property \App\Model\Table\TaxesTable&\Cake\ORM\Association\BelongsTo $Taxes
 * @property \App\Model\Table\DepositItemsTable&\Cake\ORM\Association\HasMany $DepositItems
 *
 * @method \App\Model\Entity\Deposit newEmptyEntity()
 * @method \App\Model\Entity\Deposit newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Deposit> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Deposit get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Deposit findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Deposit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Deposit> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Deposit|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Deposit saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Deposit>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Deposit>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Deposit>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Deposit> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Deposit>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Deposit>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Deposit>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Deposit> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DepositsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('deposits');
        $this->setDisplayField('reference');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CostCenters', [
            'foreignKey' => 'cost_center_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Taxes', [
            'foreignKey' => 'tax_id',
            'joinType' => 'INNER',
        ]);
          $this->hasMany('DepositItems', [
        'foreignKey' => 'deposit_id',
        'saveStrategy' => 'append', // IMPORTANT
        'dependent' => true,
    ]);
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
            ->date('doc_date')
            ->requirePresence('doc_date', 'create')
            ->notEmptyDate('doc_date');

        $validator
            ->date('psoting_date')
            ->requirePresence('psoting_date', 'create')
            ->notEmptyDate('psoting_date');

        $validator
            ->scalar('reference')
            ->maxLength('reference', 16)
            ->requirePresence('reference', 'create')
            ->notEmptyString('reference');

        $validator
            ->scalar('doc_text')
            ->maxLength('doc_text', 25)
            ->requirePresence('doc_text', 'create')
            ->notEmptyString('doc_text');

        $validator
            ->integer('account')
            ->requirePresence('account', 'create')
            ->notEmptyString('account');

        $validator
            ->integer('amount')
            ->requirePresence('amount', 'create')
            ->notEmptyString('amount');

        $validator
            ->integer('cost_center_id')
            ->notEmptyString('cost_center_id');

        $validator
            ->integer('tax_id')
            ->notEmptyString('tax_id');

         $validator
            ->scalar('order_number')
            ->maxLength('order_number', 12)
            ->allowEmptyString('order_number');

        $validator->add('order_number', 'requiredForSingle', [
            'rule' => function ($value, $context) {
                if (!empty($context['data']['deposit_items'])) {
                    return true;
                }
                return !empty($value);
            },
            'message' => 'Order number is required for single-item invoices'
        ]);

        $validator
            ->scalar('description')
            ->maxLength('description', 50)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->integer('status')
            ->notEmptyString('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['cost_center_id'], 'CostCenters'), ['errorField' => 'cost_center_id']);
        $rules->add($rules->existsIn(['tax_id'], 'Taxes'), ['errorField' => 'tax_id']);

        return $rules;
    }
}
