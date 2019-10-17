# currency_API

# API Usage

  - features
    - currency conversion

## Currency Coversion Request Format

#### GET: `https://dry-cove-37966.herokuapp.com/?to=INR&from=USD&amt=247`

#### Request Parameters
-   `to` 
-   `from`
-   `amt`[Optional]

```json
{
    "date": "2019-10-17",
    "unit_converted_data": {
        "base": "USD",
        "currency": "INR",
        "numeric": 71.2494
    },
    "unit_inverted_data": {
        "base": "INR",
        "currency": "USD",
        "numeric": 0.01404
    },
    "total": {
        "USD": {
            "amt": "247.00"
        },
        "INR": {
            "amt": "17,598.60"
        }
    }
}
```


# Contributing

- Data Fetch From [Exchange-Rates](https://www.exchange-rates.org) unofficialy.

- If the API is not working properly, please open a issue.
        
