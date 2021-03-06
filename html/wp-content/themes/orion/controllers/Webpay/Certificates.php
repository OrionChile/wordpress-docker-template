<?php

namespace Inc\Webpay;

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Contiene datos de integraciÃ³n para realizar pruebas de conectividad
 **/
class Certificates
{
public static function Certificates()
{
return array(

"config" => "dev", //dev -- prod

"commerce_code" => "597035722270",

"commerce_code_TEST_1" => "597033170351",


"private_key" => "-----BEGIN RSA PRIVATE KEY-----
MIIEogIBAAKCAQEAz3wdIIotHYjCFPUvn066lez0CqirNbDsbvYMhkgpsnFhwX/U
gWBP+mohDqSDbFfDOTgCmiChOBrqEcayHuJhWtedPfhM7pytsIpMvqlBg1809mVK
duPHFtCFkRHjkoFmZNw5zZgmHrxmCNN1/F3TYQCfYyCm0KmYQpqABytqxa/3DIPM
N504wwP5BzrMLfSJYfVjifA5KDnmcdL33hxwzq5XFJUthWTvYiNdEnqkwv6FTx5R
5IxExLP0biA/0XOtSgYYj3AohTDjZy5UrcVxeaV4H9bpuj4PohLhGPKe7jodL3Ff
7utChsQlfFKCO7sUBqm9lCY18vRsTwNAizlZXQIDAQABAoIBADrogyCM+pgrDueC
YX36jVEp0HQCRXHeBJLQeufZLzWBqX6Vu5Dr9mkjnrUYklO9aykgtORrpTpXseNQ
JZxNK9Tt6LACgl0w0MOR0I5FYdtZuaDHS2gL7aeVloaErLcY1CiIukScER6i4Nla
qGH5hZ1B3v7280XFEPy//t+KPStY8f4l50RqNbNwRfEFiBB55V3O+ZMTnjByo4H1
CJScN9doeSINhWNqvElNpkDnE/WfHpTIF5LOlIdNvZIw8t/1PmpemD7AB16NyQIG
8LNN9DzA0YQbtooLQmDPKvc5N6YbJMIWQ0xxRB8IqJCJKVj0ijOrKsSjtDOQ5alb
bUUEHmUCgYEA/NIpvA/QxK1quIMzgszL76+ijRbcTxa7DxIxRqKZ5KGo/9K0ry6o
qgwVFj1pv54sHgoeEP0UW2vBr//Gh7GRR+CUQijSa76SSS2gyWnMIQf0iHwE3XYB
E64+4nYHVQH1bjA7qdZ0AR0BVanaZ18is9+3sr2NQrPbGIJ6zW7cHPsCgYEA0hgD
Op9ynENp/LYBdzjR5eFRLnJYkHzFYWpwKz7iLM8IqbQPv0BLQ7nU4iDCZ/YnHDg1
1krzyUrToR8U+2dbXg55ky/eRpkebDhCpdRRCxCx06ENS7ycrkzEjBfuPBrs6GEk
Dd0T0RmtWryVYlWSu4gZ6+mQSN/LSY8vBq0DY4cCgYAxL3nrGnCVMt/GUdAdrFYo
pVTMehwWTufJgNKRWWTzM/g6/PUl97/chUk88Gm4W79dgL5ks7fYKVifMvWexI7t
GuX9ERAO4h53mibjyG9sJa4PN4GCzEhdWdLmH+xBP4ZOD5gr7IrZBJmT3t2cqseH
kwib/4CR74e6dvgJK34rLQKBgGCSkyFmW7uCrXxxeTkBUFKYAMYV36oDAIPn9kma
rUKlpDjFwRtLhY1LJZUQM+yv1Ih/OhgX+fnEQIVmkTGC8BfLFY1XypevGLHsJo6t
itdIREWgWUlAGNFyDkLLWUIdqlqjFHye69YJNItp9kzuQvWa+Tdc9GrbHEni3F34
N3+PAoGAPzd9+DiO1yq2Tb2U1vssWNcl34hHibVW3cWyvMy3cFAi9VuiapF8+GNB
gaI1fmEazvzlA1K74CEPo/8/h0IW8T9Qwo27xPND2c0jSGFm307oWyL/fR4+aUsd
hKptmFJK7OKNhTsu3+BiHGv0FaKH+CTi1ZezoSPDttVOTUYX2MA=
-----END RSA PRIVATE KEY-----",

"public_cert" => "-----BEGIN CERTIFICATE-----
MIIDPzCCAicCFG25zWGWJMud60B9ADxkNW4uQpOLMA0GCSqGSIb3DQEBCwUAMFwx
CzAJBgNVBAYTAkFVMRMwEQYDVQQIDApTb21lLVN0YXRlMSEwHwYDVQQKDBhJbnRl
cm5ldCBXaWRnaXRzIFB0eSBMdGQxFTATBgNVBAMMDDU5NzAzNTcyMjI3MDAeFw0y
MDEwMTYxMzQ3MjJaFw0yNDEwMTUxMzQ3MjJaMFwxCzAJBgNVBAYTAkFVMRMwEQYD
VQQIDApTb21lLVN0YXRlMSEwHwYDVQQKDBhJbnRlcm5ldCBXaWRnaXRzIFB0eSBM
dGQxFTATBgNVBAMMDDU5NzAzNTcyMjI3MDCCASIwDQYJKoZIhvcNAQEBBQADggEP
ADCCAQoCggEBAM98HSCKLR2IwhT1L59OupXs9AqoqzWw7G72DIZIKbJxYcF/1IFg
T/pqIQ6kg2xXwzk4ApogoTga6hHGsh7iYVrXnT34TO6crbCKTL6pQYNfNPZlSnbj
xxbQhZER45KBZmTcOc2YJh68ZgjTdfxd02EAn2MgptCpmEKagAcrasWv9wyDzDed
OMMD+Qc6zC30iWH1Y4nwOSg55nHS994ccM6uVxSVLYVk72IjXRJ6pML+hU8eUeSM
RMSz9G4gP9FzrUoGGI9wKIUw42cuVK3FcXmleB/W6bo+D6IS4Rjynu46HS9xX+7r
QobEJXxSgju7FAapvZQmNfL0bE8DQIs5WV0CAwEAATANBgkqhkiG9w0BAQsFAAOC
AQEArCtxMLeqzl4JWSIu2OZhBUc2l5BsA7MRyaeHFTvf0v7B2sr25b0gHZ26+8c+
OiJWblyyeiAQ7UAY212A79CrglMihz2jpunFTd1gQpZUtU7HFJ/NJ7/qWok1ZliA
fc5Z9oTT7z3MkG5pOeaKEk0Tf5cLELT66//T5b1J41X3LMJaKiDqu/esL2E7vyRI
cVMkDD7AtuNaTl07OTD3Q0GB+yVdjF3gqEymHVe4D1G+zosEjeQZL9aaeov89KZY
JKQ3t0+beQF1A4UEaDrq+ayM5hejbEMHUYfPYOq3E6ccs2hn9/DoXDo5rg0WtZ3F
NXR0VgfN8Ny1RoLJU0ILbxSSQg==
-----END CERTIFICATE-----",

"serverTBK" => "-----BEGIN CERTIFICATE-----
MIIDizCCAnOgAwIBAgIJAIXzFTyfjyBkMA0GCSqGSIb3DQEBCwUAMFwxCzAJBgNV
BAYTAkNMMQswCQYDVQQIDAJSTTERMA8GA1UEBwwIU2FudGlhZ28xEjAQBgNVBAoM
CXRyYW5zYmFuazEMMAoGA1UECwwDUFJEMQswCQYDVQQDDAIxMDAeFw0xODAzMjkx
NjA4MjhaFw0yMzAzMjgxNjA4MjhaMFwxCzAJBgNVBAYTAkNMMQswCQYDVQQIDAJS
TTERMA8GA1UEBwwIU2FudGlhZ28xEjAQBgNVBAoMCXRyYW5zYmFuazEMMAoGA1UE
CwwDUFJEMQswCQYDVQQDDAIxMDCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoC
ggEBAKRqDk/pv8GeWnEaTVhfw55fThmqbFZOHEc/Un7oVWP+ExjD0kZ/aAwMJZ3d
9hpbBExftjoyJ0AYKJXA2CyLGxRp30LapBa2lMehzdP6tC5nrCYbDFz8r8ZyN/ie
4lBQ8GjfONq34cLQfM+tOxyazgDYRnZVD9tvOcqI5bFwFKqpn/yMr9Eya7gTo/OP
wyz69sAF8MKr0YN941n6C1Cdrzp6cRftdj83nlI75Ue//rMYih/uQYiht4XWFjAA
usoOG/IVVCCHhVQGE/Rp22dAF8JzWYZWCe+ICOKjEzEZPjDBqPoh9O+0eGTFVwn2
qZf2iSLDKBOiha1wwzpTiiJV368CAwEAAaNQME4wHQYDVR0OBBYEFDfN1Tlj7wbn
JIemBNO1XrUOikQpMB8GA1UdIwQYMBaAFDfN1Tlj7wbnJIemBNO1XrUOikQpMAwG
A1UdEwQFMAMBAf8wDQYJKoZIhvcNAQELBQADggEBACzXPSHet7aZrQvMUN03jOqq
w37brCWZ+L/+pbdOugVRAQRb2W+Z6gyrJ2BuUuiZLCXpjvXACSpwcSB3JesWs9KE
YO8E8ofF7a6ORvi2Mw0vpBbwJLqnci1gVlAj3X8r/VbX2rGbvRy+BJAF769xr43X
dtns0JIWwKud0xC3iRPMnewo/75HIblbN3guePfouoR2VgfBmeU72UR8O+OpjwbF
vpidobGqTGvZtxRV5axer69WY0rAXRhTSfkvyGTXERCJ3vdsF/v9iNKHhERUnpV6
KDrfvgD9uqWH12/89hfsfVN6iRH9UOE+SKoR/jHtvLMhVHpa80HVK1qdlfqUTZo=
-----END CERTIFICATE-----"
);
}
}
