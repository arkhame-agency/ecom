<div id="description" class="tab-pane description" :class="{ active: activeTab === 'description' }">
    {!! nl2br_save_html($product->description) !!}
</div>
