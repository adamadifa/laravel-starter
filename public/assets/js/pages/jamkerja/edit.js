(function () {
    const formeditJamkerja = document.querySelector('#formeditJamkerja');
    // Form validation for Add new record
    if (formeditJamkerja) {
        const fv = FormValidation.formValidation(formeditJamkerja, {
            fields: {
                
                nama_jam_kerja: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Jam Kerja Harus Diisi'
                        }
                    }
                },

                jam_masuk: {
                    validators: {
                        notEmpty: {
                            message: 'Jam Masuk Harus Diisi'
                        }
                    }
                },

                jam_pulang: {
                    validators: {
                        notEmpty: {
                            message: 'Jam Pulang Harus Diisi'
                        }
                    }
                },
                total_jam: {
                    validators: {
                        notEmpty: {
                            message: 'Total Jam Harus Diisi'
                        }
                    }
                },

                lintas_hari: {
                    validators: {
                        notEmpty: {
                            message: 'Lintas Hari Harus Diisi'
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
