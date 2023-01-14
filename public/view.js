// import JsBarcode from 'jsbarcode';
import JsBarcode from 'jsbarcode';

document.addEventListener('DOMContentLoaded', function() {
    const barcodeSvg = document.querySelector('.barcode-svg');
    JsBarcode(barcodeSvg, '{{ $participant_tag_number }}', {
        format: 'CODE128',
        width: 2,
        height: 50,
        displayValue: true
    });
});
