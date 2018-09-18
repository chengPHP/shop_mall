<?php

return [
    'alipay' => [
        'app_id'         => '2016092100563528',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA2Y8+MVhhH5+wRQzH7UleO7OSDS5nPH0rbV9QfSGPO8euC712vTakm9fetdJ83OJ9l+WqodRIx5CUi0AVgaqW4h1DWk6HJhOOneaVQ8f41vT02CqiPOxzJYlDaIKX4BUlbSwkJsSHUkcBqb19RZklxE8pFDd/m1OSEGPNy6UgJadYK2FtvmymgCnFS14AweNGXPz6e+N5ajcUwm7elbLsygEerXI5FfifOx8NqbcmH3e+mmrnLdK5KjMqCG68003F0z/iH+8ePF9oQk2JlwdD2uurhBnOmFAK0CCLxGFeDVSPwbVAspW2TZDnY/7VkqeVW/MODMrDF+wust6e8nOP5wIDAQAB',
        'private_key'    => 'MIIEpAIBAAKCAQEA1dJjZ5Pa2EgY8zdj6KS71b1EgZVkJ60kJtMG/sK/aYUzzpaYZjFruUVY64slaVyMZXhroXjcO/mvb9/dQBCdXxe7qsdYAvOB2411dwK0mhEsNLv6yABC9wh7gTZF6TT9dY3GxpeSc+953NhcFTmFLnPXQkZ0Ko7onFRB2jR4NWtuBvoUu/40SQ2T170mu/YVaUlOmgtk6nR9Arlgg2jEmO2jLMJk8oITzL3KMi528Y0dCfxsxVY6JQSwq/+AkmrCz06LsyZz7NCUr6uWNRBH4kYzI3779Gzijn3xl7VZV7PvrqxH0TUxn00HWByKUd3xI+E5hnF3Z7TRsXI8Y012PQIDAQABAoIBAGWTLW+9+F94WInpzUduQmD2KX4ZltuWT6813oPVxhJ9ma/RMJKTdaYswGIc1ufndDab7x1lCdJf+ax+v184xVmwL5GgYzn7rbu7xoqDuYHbGJHwnuC15xntaKZoPuvbJXDbqgsbZBI5OD3mdlAK5C6+DwtH5tV00CG7kRD0jgppoMQFQWUCbZXx2ZbHpa4fVKcKnod/Et7msOFkWnXYiSXBVHA8Dqgc4v2SuIxNTDPC2f1B4udyU+tDf2LAXPae3zKsNbJI2NDSFcOizxtvhiJZhBMS3MqGpyzwvBK46rE5L3W3N30tqWYYoaSDnHgK7URk482IglJ1FI8I1aIWvCECgYEA+NiqJzuBTpmvcpi8xkOt6Iln6ExGx+jTaDxEmS8NOJozLoDx4aT4I0PsJvfs4/EBtDJ2a7aMw3qkHmQ95cLO3KPpOu5knDjtE5wB+yFexAW4A6rAEIsG2xeSEhBx3khwMx9OHiNyidv86NAoZHCjLiPQhgkcBuTNKYzFenK3KxUCgYEA2/f3t+++Xs/T4k3ATy/8sz+M46z3azvqesMCRw1rbu7trp7mkTsbapCmPJtkqB4laojuW7HeGYeGkEWanVf+U8yoXomluEcmwOmfeByTujtNHXNgdy3vmUyKuIg75VihGcY7oBu48pvVyoBQCal76IbC65DFFNorhw3HhGrjyIkCgYAr65nEiOUeqVNlB34yBBn6s93KC0Rm3joJ6LE21C4iMl0cNRf7+nDtUHyquBFwfcYONuXdxv97NPcoggrGtaZrHOb6Rr8tL4LwdhWHbHFcaaH7y7RQdylDnBpk49AlKmXbMAhKm3kIyfIOaUbny1WRvDJ+pbbzpIhtb/Ie1YZsrQKBgQCE9QwhfOMHsf0zk6WC99F5kxcY4wqmIZAoZcjxo5XldrvpyZg5/o0iy43/ojmkOJyLGXthp1BFBBr9B2VeZ7qNcm3uvqqRiUhOYKgIVNWiQofpHj0XrIdflNlgktAJX5n4105hB4Cx/CmsfgRi4rPHp/UXp+jIItseheCsFGPcaQKBgQDKF7BHi0ag/jdoKG4I9b2DyMF77E+V5oImfYp0ryvkh58yiMQM+HQn7sinkUkmq8o1DEzm/Oz4AXr1VR2nax9EZ19Y+IgpE7rpWR0GREszJrNfBGkJ1sQ6g1m2U8UCMohJf3zfXybubVpAjsiJHNjjg/WtfNrgQdHNeFMTM9qjvA==',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => '',
        'mch_id'      => '',
        'key'         => '',
        'cert_client' => '',
        'cert_key'    => '',
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];