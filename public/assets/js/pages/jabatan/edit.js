(function () {
    const formeditJabatan = document.querySelector('#formeditJabatan');
    // Form validation for Add new record
    if (formeditJabatan) {
        const fv = FormValidation.formValidation(formeditJabatan, {
            fields: {
                nama_jabatan: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Jabatan Harus Diisi'
                        }
                    }
                }

            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: '',
                    rowSelector: '.mb-3'
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),

                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
            init: instance => {
                instance.on('plugins.message.placed', function (e) {
                    if (e.element.parentElement.classList.contains('input-group')) {
                        e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                    }
                });
            }
        });
    }
})();
