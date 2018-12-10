<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TestPlan[]|\Cake\Collection\CollectionInterface $testPlans
 */
?>
<div>
    <div class="text-center">
        <br>
        <h3><?= __('Test Plans') ?></h3>
    </div>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($testPlans as $testPlan): ?>
            <tr>
                <td><?= $this->Html->link(__($testPlan->name), ['action' => 'view', $testPlan->id]) ?></td>
                <td><?= h($testPlan->description) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
