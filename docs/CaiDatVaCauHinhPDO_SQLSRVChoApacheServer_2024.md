CÁCH CÀI VÀ CẤU HÌNH DRIVE PDO_SQLSRV CHO APACHE SERVER

Bước 1: Xem coi PDO_SQLSRV đã cài chưa, nếu chưa cài thì qua bước 2

&lt;?php

// Kiểm tra các drives PDO sẵn có

var_dump(PDO::getAvailableDrivers());

?&gt;

Bước 2: Tải drive PDO_SQLSRV

Link chi tiết: https://www.php.net/manual/en/ref.pdo-sqlsrv.php

Link GitHub: https://github.com/microsoft/msphpsql

Giải nén tập tin SQLSRV512.ZIP ra thư mục, ta sẽ được các tập tin:

Driver file

PHP version

Thread safe?

Use with PHP .dll

php_sqlsrv_81_nts_x86.dll

8.1

no

php8.dll

php_pdo_sqlsrv_81_nts_x86.dll

php_sqlsrv_81_ts_x86.dll

yes

php8ts.dll

php_pdo_sqlsrv_81_ts_x86.dll

php_sqlsrv_81_nts_x64.dll

no

php8.dll

php_pdo_sqlsrv_81_nts_x64.dll

php_sqlsrv_81_ts_x64.dll

yes

php8ts.dll

php_pdo_sqlsrv_81_ts_x64.dll

php_sqlsrv_82_nts_x86.dll

8.2

no

php8.dll

php_pdo_sqlsrv_82_nts_x86.dll

php_sqlsrv_82_ts_x86.dll

yes

php8ts.dll

php_pdo_sqlsrv_82_ts_x86.dll

php_sqlsrv_82_nts_x64.dll

no

php8.dll

php_pdo_sqlsrv_82_nts_x64.dll

php_sqlsrv_82_ts_x64.dll

yes

php8ts.dll

php_pdo_sqlsrv_82_ts_x64.dll

php_sqlsrv_83_nts_x86.dll

8.3

no

php8.dll

php_pdo_sqlsrv_83_nts_x86.dll

php_sqlsrv_83_ts_x86.dll

yes

php8ts.dll

php_pdo_sqlsrv_83_ts_x86.dll

php_sqlsrv_83_nts_x64.dll

no

php8.dll

php_pdo_sqlsrv_83_nts_x64.dll

php_sqlsrv_83_ts_x64.dll

yes

php8ts.dll

php_pdo_sqlsrv_83_ts_x64.dll

Bước 3: Cấu hình Apache server

Copy 2 tập tin DLL với phiên bản muốn sử dụng vào thư mục ext của php tương ứng.

Ví dụ: Máy tôi cài Win10 64 bit, hỗ trợ đa luồng, và đang sử dụng phiên bản PHP 8.3.6, tôi sẽ copy 2 tập tin php_sqlsrv_83_ts_x64.dll, php_pdo_sqlsrv_83_ts_x64.dll vào thư mục ext.

Mở tập tin phpForApache.ini trong thư mục PHP đang sử dụng.

Sau đó bổ sung thêm 2 dòng mới:

Khởi động lại server, và kiểm tra lại danh sách drivers:

Bước 4: Kiểm tra bằng code đơn giản

Giả sử trong SQL Server đã có CSDL TrangTin như sau:

Code PHP mẫu:

&lt;?php

    $dsn = 'sqlsrv:Server=.\SQLEXPRESS;Database=TrangTin';

    $user = 'sa';

    $pass = 'sqlserver17';

    

    // Kết nối

    $conn = new PDO($dsn, $user, $pass);

    

    // Lấy dữ liệu

    $sql = "SELECT * FROM ChuDe";

    $cmd = $conn-&gt;prepare($sql);

    $cmd-&gt;execute();

    $result = $cmd-&gt;fetchAll();

    

    var_dump($result);

?&gt;

Kết quả:

-- HẾT --