<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Message'), ['action' => 'edit', $message->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Message'), ['action' => 'delete', $message->id], ['confirm' => __('Are you sure you want to delete # {0}?', $message->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Messages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Message'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lost Items'), ['controller' => 'LostItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lost Item'), ['controller' => 'LostItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="messages view large-9 medium-8 columns content">
    <h3><?= h($message->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Lost Item') ?></th>
            <td><?= $message->has('lost_item') ? $this->Html->link($message->lost_item->name, ['controller' => 'LostItems', 'action' => 'view', $message->lost_item->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Text') ?></th>
            <td><?= h($message->text) ?></td>
        </tr>
        <tr>
            <th><?= __('Message') ?></th>
            <td><?= h($message->message) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($message->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Senderid') ?></th>
            <td><?= $this->Number->format($message->senderid) ?></td>
        </tr>
        <tr>
            <th><?= __('Recipientid') ?></th>
            <td><?= $this->Number->format($message->recipientid) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($message->created) ?></td>
        </tr>
    </table>
</div>
