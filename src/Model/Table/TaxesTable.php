<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Taxes Model
 *
 * @property \App\Model\Table\DepositsTable&\Cake\ORM\Association\HasMany $Deposits
 * @property \App\Model\Table\RentalsTable&\Cake\ORM\Association\HasMany $Rentals
 *
 * @method \App\Model\Entity\Tax newEmptyEntity()
 * @method \App\Model\Entity\Tax newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Tax> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tax get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Tax findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Tax patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Tax> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tax|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Tax saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Tax>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tax>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tax>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tax> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tax>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tax>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tax>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tax> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TaxesTable extends Table
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

        $this->setTable('taxes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Deposits', [
            'foreignKey' => 'tax_id',
        ]);
        $this->hasMany('Rentals', [
            'foreignKey' => 'tax_id',
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
            ->scalar('name')
            ->maxLength('name', 10)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('status')
            ->notEmptyString('status');

        return $validator;
    }
}
