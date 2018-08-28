</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">

    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<?php echo $this->element('common-footer'); ?> 
<?php
echo $this->Html->script(
        array(
            'admin/menu',
            //div view by payment category
            'customerinfo',
            // datepicker range            
            '/jquery-ui-daterangepicker-0.4.3/jquery-ui',
            '/jquery-ui-daterangepicker-0.4.3/moment.min',
            '/jquery-ui-daterangepicker-0.4.3/jquery.comiseo.daterangepicker',
            //  'formValidationJs/1.jquery-1.11.1.min',
            'formValidationJs/2.jquery.validate.min',
            'formValidationJs/3.additional-methods.min',
            'formValidationJs/formValidation',
            '/assets/admin/pages/scripts/components-dropdowns',
//            '/smartMenusPlugin/jquery',
        )
);
?>

<script>
    $(function () {
        $("#e1").daterangepicker();
    });
    $(function () {
        $(".e1").daterangepicker();
    });
    $(function () {
        $(".dateRange").daterangepicker();
    });

    $(".e1").daterangepicker({
        presetRanges: [{
                text: 'Today',
                dateStart: function () {
                    return moment()
                },
                dateEnd: function () {
                    return moment()
                }
            }, {
                text: 'Tomorrow',
                dateStart: function () {
                    return moment().add('days', 1)
                },
                dateEnd: function () {
                    return moment().add('days', 1)
                }
            }, {
                text: 'Next 7 Days',
                dateStart: function () {
                    return moment()
                },
                dateEnd: function () {
                    return moment().add('days', 6)
                }
            }, {
                text: 'Next Week',
                dateStart: function () {
                    return moment().add('weeks', 1).startOf('week')
                },
                dateEnd: function () {
                    return moment().add('weeks', 1).endOf('week')
                }
            }],
        applyOnMenuSelect: false,
        datepickerOptions: {
            maxDate: null
        }
    });
    $("#e2").daterangepicker({
        presetRanges: [{
                text: 'Today',
                dateStart: function () {
                    return moment()
                },
                dateEnd: function () {
                    return moment()
                }
            }, {
                text: 'Tomorrow',
                dateStart: function () {
                    return moment().add('days', 1)
                },
                dateEnd: function () {
                    return moment().add('days', 1)
                }
            }, {
                text: 'Next 7 Days',
                dateStart: function () {
                    return moment()
                },
                dateEnd: function () {
                    return moment().add('days', 6)
                }
            }, {
                text: 'Next Week',
                dateStart: function () {
                    return moment().add('weeks', 1).startOf('week')
                },
                dateEnd: function () {
                    return moment().add('weeks', 1).endOf('week')
                }
            }],
        applyOnMenuSelect: false,
        datepickerOptions: {
            maxDate: null
        }
    });

    $("#e3").daterangepicker({
        presetRanges: [{
                text: 'Today',
                dateStart: function () {
                    return moment()
                },
                dateEnd: function () {
                    return moment()
                }
            }, {
                text: 'Tomorrow',
                dateStart: function () {
                    return moment().add('days', 1)
                },
                dateEnd: function () {
                    return moment().add('days', 1)
                }
            }, {
                text: 'Next 7 Days',
                dateStart: function () {
                    return moment()
                },
                dateEnd: function () {
                    return moment().add('days', 6)
                }
            }, {
                text: 'Next Week',
                dateStart: function () {
                    return moment().add('weeks', 1).startOf('week')
                },
                dateEnd: function () {
                    return moment().add('weeks', 1).endOf('week')
                }
            }],
        applyOnMenuSelect: false,
        datepickerOptions: {
            maxDate: null
        }
    }
    );
    $(".e3").daterangepicker({
        presetRanges: [{
                text: 'Today',
                dateStart: function () {
                    return moment()
                },
                dateEnd: function () {
                    return moment()
                }
            }, {
                text: 'Tomorrow',
                dateStart: function () {
                    return moment().add('days', 1)
                },
                dateEnd: function () {
                    return moment().add('days', 1)
                }
            }, {
                text: 'Next 7 Days',
                dateStart: function () {
                    return moment()
                },
                dateEnd: function () {
                    return moment().add('days', 6)
                }
            }, {
                text: 'Next Week',
                dateStart: function () {
                    return moment().add('weeks', 1).startOf('week')
                },
                dateEnd: function () {
                    return moment().add('weeks', 1).endOf('week')
                }
            }],
        applyOnMenuSelect: false,
        datepickerOptions: {
            maxDate: null
        }
    }
    );



    $("#e4").daterangepicker({
        presetRanges: [{
                text: 'Today',
                dateStart: function () {
                    return moment()
                },
                dateEnd: function () {
                    return moment()
                }
            }, {
                text: 'Tomorrow',
                dateStart: function () {
                    return moment().add('days', 1)
                },
                dateEnd: function () {
                    return moment().add('days', 1)
                }
            }, {
                text: 'Next 7 Days',
                dateStart: function () {
                    return moment()
                },
                dateEnd: function () {
                    return moment().add('days', 6)
                }
            }, {
                text: 'Next Week',
                dateStart: function () {
                    return moment().add('weeks', 1).startOf('week')
                },
                dateEnd: function () {
                    return moment().add('weeks', 1).endOf('week')
                }
            }],
        applyOnMenuSelect: false,
        datepickerOptions: {
            minDate: 0,
            maxDate: null
        }
    });
    $(".e4").daterangepicker({
        presetRanges: [{
                text: 'Today',
                dateStart: function () {
                    return moment()
                },
                dateEnd: function () {
                    return moment()
                }
            }, {
                text: 'Tomorrow',
                dateStart: function () {
                    return moment().add('days', 1)
                },
                dateEnd: function () {
                    return moment().add('days', 1)
                }
            }, {
                text: 'Next 7 Days',
                dateStart: function () {
                    return moment()
                },
                dateEnd: function () {
                    return moment().add('days', 6)
                }
            }, {
                text: 'Next Week',
                dateStart: function () {
                    return moment().add('weeks', 1).startOf('week')
                },
                dateEnd: function () {
                    return moment().add('weeks', 1).endOf('week')
                }
            }],
        applyOnMenuSelect: false,
        datepickerOptions: {
            minDate: 0,
            maxDate: null
        }
    });
</script>
</body>
<!-- END BODY -->
</html>