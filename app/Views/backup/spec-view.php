<!-- <div x-show="open" x-collapse class="divide-y divide-gray-100">
            <?php foreach ($category->specs as $spec): ?>
              <div
                x-data="{ checked: false, value: '' }"
                class="flex items-center gap-4 px-4 py-3 hover:bg-gray-50 transition-colors">

                <input
                  type="checkbox"
                  x-model="checked"
                  id="spec_<?= esc($spec->spec_no) ?>"
                  class="shrink-0 size-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500 cursor-pointer">

                <label
                  for="spec_<?= esc($spec->spec_no) ?>"
                  class="text-sm text-gray-700 w-40 shrink-0 cursor-pointer">
                  <?= esc($spec->spec_name) ?>
                  <?php if (!empty($spec->spec_unit)): ?>
                    <span class="text-xs text-gray-400">(<?= esc($spec->spec_unit) ?>)</span>
                  <?php endif; ?>
                </label>

                <input
                  type="text"
                  x-model="value"
                  :disabled="!checked"
                  @change="checked && $dispatch('spec-updated', { spec_no: '<?= esc($spec->spec_no) ?>', vsc_no: '<?= esc($category->vsc_no) ?>', value })"
                  placeholder="Enter value..."
                  class="flex-1 py-1.5 px-3 text-sm border border-gray-200 rounded-md focus:border-primary-500 focus:ring-primary-500 disabled:opacity-40 disabled:pointer-events-none">
              </div>
            <?php endforeach; ?>
          </div> -->

<!-- Spec Rows -->
<div x-show="open" x-collapse class="divide-y divide-gray-50">
  <!-- Loop spec rows here (spec_type filtered by category) -->
  <?php foreach ($spec_type as $spec): /* filter by category */ ?>
    <div class="grid grid-cols-2 gap-3 items-center px-5 py-3">
      <label class="flex items-center gap-3 cursor-pointer">
        <input type="checkbox" name="specs[]" value="<?= $spec->spec_no ?>"
          class="size-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
        <div>
          <p class="text-sm text-gray-800"><?= esc($spec->spec_title) ?></p>
          <p class="text-xs text-gray-400"><?= esc($spec->spec_unit ?? '') ?></p>
        </div>
      </label>
      <input type="text" name="spec_value[<?= $spec->spec_no ?>]"
        placeholder="Enter value..."
        class="py-1.5 px-3 text-sm border border-gray-200 rounded-lg bg-gray-50 text-gray-800 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 w-full">
    </div>
  <?php endforeach; ?>
</div>