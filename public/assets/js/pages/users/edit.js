(function () {
    const formeditUser = document.querySelector('#formeditUser');
    // Form validation for Add new record
    if (formeditUser) {
        const fv = FormValidation.formValidation(formeditUser, {
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'Nama User Harus Diisi'
                        }
                    }
                },

                username: {
                    validators: {
                        notEmpty: {
                            message: 'Username Harus Diisi'
                        }
                    }
                },

                email: {
                    validators: {
                        notEmpty: {
                            message: 'Email Harus Diisi'
                        },
                        emailAddress: {
                            message: 'Silahkan Masukan Email yang Valid'
                        }
                    }
                },

                kode_unit: {
                    validators: {
                        notEmpty: {
                            message: 'Unit Harus Dipilih'
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
