# Naran GeoIP
클라이언트의 접속 국가를 IP 주소에서 파악합니다.


## 사용 방법
1. `wp_content/plugins` 디렉토리에 이 플러그인을 업로드하세요.
2. 관리자 플러그인 항목에서 'Naran GeoIP'를 찾아 활성화 하세요.
3. 관리자 설정 > NGIP를 찾아 MaxMind GeoIP2 라이센스 키를 입력하세요.


## 사용 함수 

### ngip_geolocate_ip()
접속자의 IP를 기준으로 접속 위치를 파악합니다.

길이 2의 배열을 리턴합니다. 0번째는 찾아낸 클라이언트의 (외부) IP,
1번째는 국가 코드입니다.

---

### ngip_query_maxmind_database()
MaxMind 데이터베이스의 자세한 결과를 리턴합니다.

* $ip: 외부 IP를 입력해야 합니다.

---

### ngip_get_external_ip( bool $cache_local_ip )
외부 IP를 조사합니다.

* $cache_local_ip: 외부 IP와 내부 IP와의 매핑이 이뤄지면 1주간 캐싱됩니다.
                   개발 환경에서 이 캐시를 사용하지 않기 위해 필요한 인자입니다.  

---

### ngip_get_database_path()
MaxMind 데이터베이스가 저장된 위치를 리턴합니다.

---

### ngip_get_database_version()
현재 MaxMind 데이터베이스의 버전을 리턴합니다.

---

### ngip_get_maxmind_license_key()
라이센스 키를 리턴합니다.

---

## 일러두기
이 플러그인은 MaxMind GeoLite2-City 데이터베이스를 기반으로 동작합니다.
IP로는 정확한 위치를 판별할 수 없습니다. 다만 대략으로 국가나 주변 도시 정도를 파악할 수 있다고 생각해 주세요.

MaxMind 라이센스 키를 받지 않으면 IP 기반 위치 파악이 불가하고,
데이터베이스의 자동 갱신도 불가능합니다. 정확한 키를 입력하세요.
