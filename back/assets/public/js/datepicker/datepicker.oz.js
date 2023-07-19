/*(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? factory(require('jquery')) :
  typeof define === 'function' && define.amd ? define(['jquery'], factory) :
  (factory(global.jQuery));
}(this, (function ($) {

  'use strict';

  $.fn.datepicker.languages['uz'] = {
    format: 'dd.mm.YYYY',
    days: ["Yakshanba", "Dushanba", "Seshanba", "Chorshanba", "Payshanba", "Juma", "Shanba"],
    daysShort: ['Ya', 'Du', 'Se', 'Ch', 'Pa', 'Ju', 'Sh'],
    daysMin: ['Ya', 'Du', 'Se', 'Ch', 'Pa', 'Ju', 'Sh'],
    months: ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'May', 'Iyun', 'Iyul', 'Avgust', 'Sentyabr', 'Oktyabr', 'Noyabr', 'Dekabr',],
    monthsShort: ['Yan', 'Fev', 'Mar', 'Apr', 'May', 'Iyun', 'Iyul', 'Avg', 'Sen', 'Okt', 'Noy', 'Dek'],
    weekStart: 1,
    startView: 0,
    yearFirst: false,
    yearSuffix: ''
  };
})));*/

(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? factory(require('jquery')) :
  typeof define === 'function' && define.amd ? define(['jquery'], factory) :
  (factory(global.jQuery));
}(this, (function ($) {

  'use strict';

  $.fn.datepicker.languages['uz'] = {
    format: 'dd.mm.YYYY',
    days: ["�������", "�������", "�������", "��������", "��������", "����", "�����"],
    daysShort: ['�', '��', '��', '�', '��', '��', '�'],
    daysMin: ['�', '��', '��', '�', '��', '��', '�'],
    months: ['�����', '������', '����', '�����', '���', '���', '���', '������', '�������', '������', '�����', '������'],
    monthsShort: ['��', '���', '���', '���', '���', '���', '���', '���', '���', '���', '���', '���'],
    weekStart: 1,
    startView: 0,
    yearFirst: false,
    yearSuffix: ''
  };
})));
