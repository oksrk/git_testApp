
<?php $__env->startSection('content'); ?>


<div class="mt-20 mb-10 flex justify-between">
  <h1 class="text-base">TODO一覧</h1>
  <button
    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
  >
    <a href="<?php echo e(route('todo.create')); ?>">新規追加</a>
  </button>
</div>
<div>
  <table class="table-auto">
    <thead>
      <tr>
        <th class="px-4 py-2">タイトル</th>
        <th class="px-4 py-2">やること</th>
        <th class="px-4 py-2">作成日時</th>
        <th class="px-4 py-2">更新日時</th>
      </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $todos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $todo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td class="border px-4 py-2"><?php echo e($todo->title); ?></td>
        <td class="border px-4 py-2"><?php echo e($todo->content); ?></td>
        <td class="border px-4 py-2"><?php echo e($todo->created_at); ?></td>
        <td class="border px-4 py-2"><?php echo e($todo->updated_at); ?></td>
        <td class="border px-4 py-2">
        <a
            class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
            href="<?php echo e(route('todo.edit', $todo->id)); ?>"
        >
            編集
        </a>
        </td>
        <?php echo Form::open(['method' => 'delete', 'route' => ['todo.destroy',
        $todo->id]]); ?>

        <td class="border px-4 py-2">
        <button
            class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
        >
            削除
        </button>
        </td>
        <?php echo Form::close(); ?>

    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php echo e($todos->links()); ?>

    </tbody>
  </table>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/Users/31501/Downloads/php/testApp/resources/views/todo/index.blade.php ENDPATH**/ ?>