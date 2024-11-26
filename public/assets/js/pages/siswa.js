(function () {
    const formSiswa = document.querySelector('#formSiswa');
    // Form validation for Add new record
    if (formSiswa) {
        const fv = FormValidation.formValidation(formSiswa, {
            fields: {

                nama_lengkap: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Lengkap Harus Diisi'
                        }
                    }
                },
                jenis_kelamin: {
                    validators: {
                        notEmpty: {
                            message: 'Jenis Kelamin Harus Diisi'
                        }
                    }
                },
                tempat_lahir: {
                    validators: {
                        notEmpty: {
                            message: 'Tempat Lahir Harus Diisi'
                        }
                    }
                },
                tanggal_lahir: {
                    validators: {
                        notEmpty: {
                            message: 'Tanggal Lahir Harus Diisi'
                        }
                    }
                },


                anak_ke: {
                    validators: {
                        notEmpty: {
                            message: 'Anak Ke Harus Diisi'
                        }
                    }
                },

                alamat: {
                    validators: {
                        notEmpty: {
                            message: 'Alamat Harus  Diisi'
                        }
                    }
                },

                id_province: {
                    validators: {
                        notEmpty: {
                            message: 'Provinsi Harus  Diisi'
                        }
                    }
                },

                id_regency: {
                    validators: {
                        notEmpty: {
                            message: 'Kabupaten / Kota Harus Diisi'
                        }
                    }
                },

                id_district: {
                    validators: {
                        notEmpty: {
                            message: 'Kecamatan Harus Diisi'
                        }
                    }
                },

                id_village: {
                    validators: {
                        notEmpty: {
                            message: 'Desa / Kelurahan Harus Diisi'
                        }
                    }
                },

                no_kk: {
                    validators: {
                        notEmpty: {
                            message: 'No. KK Harus Diisi'
                        }
                    }
                },

                nik_ayah: {
                    validators: {
                        notEmpty: {
                            message: 'Nik Ayah Harus Diisi'
                        }
                    }
                },

                nama_ayah: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Ayah Harus Diisi'
                        }
                    }
                },

                pendidikan_ayah: {
                    validators: {
                        notEmpty: {
                            message: 'Pendidikan Ayah Harus Diisi'
                        }
                    }
                },

                pekerjaan_ayah: {
                    validators: {
                        notEmpty: {
                            message: 'Pekerjaan Ayah Harus Diisi'
                        }
                    }
                },

                nik_ibu: {
                    validators: {
                        notEmpty: {
                            message: 'NIK Ibu Harus Diisi'
                        }
                    }
                },

                nama_ibu: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Ibu Harus Diisi'
                        }
                    }
                },

                pendidikan_ibu: {
                    validators: {
                        notEmpty: {
                            message: 'Pendidikan Ibu Harus Diisi'
                        }
                    }
                },

                pekerjaan_ibu: {
                    validators: {
                        notEmpty: {
                            message: 'Pekerjaan Ibu Harus Diisi'
                        }
                    }
                },

                no_hp_orang_tua: {
                    validators: {
                        notEmpty: {
                            message: 'No. HP Orang tua Harus Diisi',
                        }
                    }
                },


                kode_pos: {
                    validators: {
                        notEmpty: {
                            message: 'Kode POS Harus Diisi',
                        }
                    }
                },





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
