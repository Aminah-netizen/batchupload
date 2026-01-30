<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RentalItems Model
 *
 * @property \App\Model\Table\RentalsTable&\Cake\ORM\Association\BelongsTo $Rentals
 *
 * @method \App\Model\Entity\RentalItem newEmptyEntity()
 * @method \App\Model\Entity\RentalItem newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RentalItem> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RentalItem get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RentalItem findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RentalItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RentalItem> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RentalItem|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RentalItem saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RentalItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RentalItem>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RentalItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RentalItem> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RentalItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RentalItem>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RentalItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RentalItem> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RentalItemsTable extends Table
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

        $this->setTable('rental_items');
        $this->setDisplayField('reference');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Rentals', [
        'foreignKey' => 'rental_id',
        'joinType' => 'INNER',
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
            ->integer('rental_id')
            ->notEmptyString('rental_id');

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
            ->integer('amount')
            ->requirePresence('amount', 'create')
            ->notEmptyString('amount');

        $validator
            ->scalar('order_number')
            ->maxLength('order_number', 12)
            ->allowEmptyString('order_number');

        $validator->add('order_number', 'requiredForNon31', [
            'rule' => function ($value, $context) {
                $lineNo = $context['data']['line_no'] ?? null;

                // line 31 (rental) → allow empty
                if ((int)$lineNo === 31) {
                    return true;
                }

                // other lines (40 etc) → required
                return !empty($value);
            },
            'message' => 'Order number is required for non-rental items'
        ]);

        $validator
            ->scalar('description')
            ->maxLength('description', 50)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->integer('line_no')
            ->requirePresence('line_no', 'create')
            ->notEmptyString('line_no');

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
        $rules->add($rules->existsIn(['rental_id'], 'Rentals'), ['errorField' => 'rental_id']);

        return $rules;
    }
}
