define({ "api": [
  {
    "type": "get",
    "url": "currency?to=USD&from=INR&amt=10",
    "title": "Request Currency information",
    "name": "GetCurrency_Info",
    "group": "Currency",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "from",
            "optional": false,
            "field": "from",
            "description": "<p>Currency Code.</p>"
          },
          {
            "group": "Parameter",
            "type": "to",
            "optional": false,
            "field": "to",
            "description": "<p>Currency Code.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "./index.php",
    "groupTitle": "Currency"
  },
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "./apidoc/main.js",
    "group": "_var_www_html_currency_apidoc_main_js",
    "groupTitle": "_var_www_html_currency_apidoc_main_js",
    "name": ""
  }
] });
