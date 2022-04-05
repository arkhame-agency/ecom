import { trans } from '../../../functions';

export function collapseFilters() {
    let $offCanvasFiler = $('.offcanvas__filter--sidebar');
    if ($offCanvasFiler.length !== 0) {
        $offCanvasFiler.removeClass('active');
        $('body').removeClass('offcanvas__filter--sidebar_active');
    }
    $('.filter-checkbox').each(function () {
        let self = $(this);
        let filterCollapseCheckbox = self.children().eq(4).nextAll('.form-check');

        filterCollapseCheckbox.hide();
        self.next().remove();

        if (self.children().length > 5) {
            self.after(`<span class="btn-show-more">${trans('storefront::products.show_more')}</span>`);

            self.next().on('click', (e) => {
                let target = $(e.currentTarget);
                let showMoreText = trans('storefront::products.show_more');
                let showLessText = trans('storefront::products.show_less');

                target.text(target.text() === showMoreText ? showLessText : showMoreText);

                filterCollapseCheckbox.slideToggle(200);
            });
        }
    });
}
