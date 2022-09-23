# Desgin pattern

Đề bài:    demo các tính năng của package https://github.com/FakerPHP/Faker

# Các khái niệm

### 1. Composer

1. Khái niệm:  
   Composer là Dependency Management trong PHP. Nói một cách chính xác hơn, **composer** quản lý sự phụ thuộc các tài
   nguyên trong
   dự án. Nó cho phép khai báo các thư viện mà dự án của bạn sử dụng, composer **tự động tải** code của thư viện về dự
   án của bạn.
   Nó tạo ra các file cần thiết vào project của bạn và tự động cập nhật khi các thư viện có phiên bản mới.

2. Lợi ích của composer:

- Khai báo các thư viện mà dự án sử dụng. Quản lý tập trung các các thư viện đang sử dụng trong project và cả phiên bản
  của nó qua file `composer.json`
- Tìm các phiên bản của package có thể cài đặt và cần thiết cho dự án , sau đó cài đặt nó vào dự án.

3. Sử dụng

Khi sử dụng **Composer** trong thư mục gốc của chúng ta có file **composer.json** :

```php 
{
    "name": "vannghia/my_project",
    "description": "My New Project",
    "authors": [
    {
        "name": "Vu Van Nghia",
        "email": "admin@nghiavu.com"
    }],
    "require": {
        "monolog/monolog": "1.12.0"
    }
}
```

Trong đó :

- **name**: tên dự án có dạng **vendor_name**/**package_name** .
- **description**: Mô tả dự án của bạn.
- **author**: tên tác giả dự án
- **require** đây chính là danh sách các package thư viện cần thiết, nó sẽ lấy từ server về. sẽ có 2 phần là tên vendor/
  tên gói cùng với chỉ định version hay không.

sau đó chạy lệnh **composer install**. Nó sẽ đưa tất cả các phụ thuộc vào 1 thư mục có tên là **vendor** và thực hiện
các công việc khác. Đồng
thời sẽ tạo ra 1 file **composer.lock**. Tác dụng của file này là khóa các phiên bản của của các components được sử dụng
trong dự án. File này bảo đảm chắc chắn rằng mọi người
sẽ sử dụng cùng 1 phiên bản của các file.

Để sử dụng được các thư viện đó bạn chỉ viện chèn autoload.php vào file cần thiết:
`require 'vendor/autoload.php'`

Chỉ định version cho các dependency. có 6 cách xác định:

1. Version range.  
   Bằng cách sử dụng các toán tử so sánh bạn có thể lấy version cao hơn, thấp hơn hoặc tuân theo một số các nguyên tắc
   thậm
   chí phức tạp hơn như sử dụng AND và OR. Các toán tử có thể là >, <,> =, <= và !=. AND được biểu diễn bằng một dấu
   cách
   hoặc dấu phẩy, OR được biểu diễn bằng hai dấu gạch dọc: ||.

   Ví dụ >2.7 nghĩa là bất kỳ version nào trên 2.7. >2.7 <=3.5 bao gồm các version từ 2.7 trở lên tới 3.5 (bao gồm cả 3.5).
2. wildcard verion 


Bằng cách sử dụng 1 ký tự đại diện, bạn có thể sử dụng 1 pattern .x.x.* sẽ bao gồm các version x.x.0 trở lên  và trở xuống.( bao gồm x.x nhưng không gồm x.y)  

Ví dụ 2.3.* sẽ bao gồm từ 2.3.0 trở lên và trừ 2.4 Nó tương đương với >=2.3.0 <2.4  
3. Hyphen Ranges

cho phép bạn xác định range dễ dàng hơn, mặc dù bạn sẽ cảm thấy bối rối hơn một chút vì cách nó xử lý các partial version. Full version gồm ba số trong trường hợp hyphen ranges thực hiện đầy đủ ý nghĩa của nó

2.0.0 – 3.0.0 nghĩa là tất cả các version bao gồm 2.0.0 trở lên và bao gồm 3.0.0 trở xuống.

2.0 – 3.0 bao gồm bất kỳ version nào kể cả 2.0 trở lên nhưng không bao gồm version 3.1

4. Tiddle Range  
   Tiddle Range rất tuyệt vời để đáp ứng các yêu cầu nhỏ nhất cho việc xác định version và chấp nhận bất kỳ version nào trở lên, nhưng không bao gồm chính nó. Nếu chỉ rõ là ~3.6 thì bạn chấp nhận các version từ 3.6 trở lên nhưng không bao gồm 4.0.

Method này tương đương với >-3.6 <4.0
5. Caret Range  
   Caret Range có nghĩa là chấp nhận tất cả các phiên bản hiện tại tính từ nó nhưng không bao gồm phiên bản lớn hơn. Ví dụ ^3.3.5 bạn chấp nhận bất kỳ version nào trở lên, nhưng không bao gồm4.0

6. Locking trong Composer  
   Locking là một trong những tính năng hữu ích nhất của Composer. Trước tiên ta sẽ nói đến composer.lock. Công việc của nó là khóa lại các versions của các components đã sử dụng. Lock file có thể chắc chắn rằng mọi người làm việc với các versions giống nhau của các files.

Khi lần đầu tiên sử dụng Composer để lấy một dependency nó sẽ ghi chính xác version vào file Composer.lock. Ví dụ như nếu bạn chỉ rõ 2.3.* và 2.3.5 là version mới nhất thì version được cài đặt sẽ là 2.3.5 và nó sẽ được đưa vào trong lock file.

Giả sử sau 1 tuần có một developer gia nhập team của bạn. Trong thời gian này dependency đã được update lên 2.3.6. Nếu anh ta sử dụng câu lệnh (composer install) thì sẽ nhận được2.3.5 vì nó đã được ghi trong file lock.

Tất nhiên bạn có thể quyết định việc update các dependencies của mình. Trong trường hợp đó, bạn sẽ thực hiện lệnh :

```php
composer update 
```
Nó sẽ lấy các version mới nhất và ghi chúng vào file lock.





Sử dụng `composer update` để cập nhật các dependency của bạn, nó sẽ lấy các version mới nhất và ghi vào file lock.

**chú ý**: không bao giở sử dụng `composer update ` trên môi trường production để tránh các trường hợp không tương
thích.

**require dev** cho phép bạn xác định các dependencies cho môi trường dev. Ghi các dependencies vào mảng `require-dev`


## PHP standard recommendation

### PRS 1 - Basic Coding Standards 

1. Tổng quan : 
  
 - Tệp phải sử dụng  thẻ `<?php ` và `<?=`
 - Tệp phải sử dụng UTF-8 không có BOM cho mã 
 - Tên tệp phải khai báo các ký hiệu ( hằng ,lớp, hàm ) hoặc hiệu ứng phụ ( vd: tạo đầu ra, thay đổi cài đặt ini.php ) nhưng không nên là cả hai. 
 - Không gian tên và lớp phải tuân thủ theo `tự động tải `PSR[PSR-0 , PSR-4]
 - Tên lớp phải là PascalCase  `class ActionPeople`
 - Hằng của lớp phải viết hoa và phân cách bằng dấu gạch dưới: `const MAX_INT`
 - Tên phương thức phải khai báo dạng camelCase `function sayHello `


2. Tệp
 
2.1 Thẻ PHP  
 
Mã PHP phải sử dụng thẻ `<?php ?> ` hoặc kiểu xuất ngắn `<?= ?>`; không sử dụng các biến thể khác. 

2.2 Ký tự kết thúc 
Mã PHP chỉ sử dụng UTF-8 không BOM 


2.3. Hiệu ứng phụ 
Một file nên khai báo các ký hiệu mới ( lớp, hàm, hằng,..) và không gây ra hiệu ứng phụ, hoặc nó nên thực thi logic mà với hiệu ứng phụ nhưng không nên làm cả hai 

Cụm từ 'hiệu ứng phụ ' nghĩa là thực thi các logic không trực tiếp liên quan đến khai báo lớp, hàm, hằng,..  chỉ đơn thuần từ việc bao gồm tệp.  
Hiệu ứng phụ bao gồm nhưng không giới hạn với: sinh đầu ra, sử dụng rõ ràng require hay include, kết nối với dịch vụ bên ngoài, điều chỉnh tệp init, phát ra cảnh báo hay ngoại lệ, điều chỉnh biến toàn cục hay biến tĩnh, đọc hay viết từ 1 file và hơn thế nữa. 


Dưới đây là 1 ví dụ của file với cả khai báo và hiệu ứng phụ, nên tránh :

```php 
<?php
// side effect: change ini settings
ini_set('error_reporting', E_ALL);

// side effect: loads a file
include "file.php";

// side effect: generates output
echo "<html>\n";

// declaration
function foo()
{
    // function body
}
```

3. Không gian tên và lớp 

- Không gian tên và lớp phải tuân theo tự động tải PSR[PSR-0, PSR-4]
- Tên lớp phải là `PascalCase`

4. Hằng lớp, thuộc tính và phương thức

Từ khóa 'class' tham chiếu tới tất cả các class, interface, và traits 
4.1 Hằng 
Hằng lớp phải khai báo in hoa và các từ cách nhau bởi dấu gạch dưới. 



4. Class Constants, Properties, and Methods
   The term "class" refers to all classes, interfaces, and traits.

```php 

<?php
namespace Vendor\Model;

class Foo
{
    const VERSION = '1.0';
    const DATE_APPROVED = '2012-06-01';
}
```
4.2. Thuộc tính 
 Điều này hướng dẫn tránh bất kỳ gợi ý nào kể cả việc sử dụng $camelCase, or $under_score tên thuộc tính 

Bất kể quy ước tên nào đựọc sử dụng nên được áp dụng 1 cách nhất quán trong phạm vi hợp lý. Phạm vi đó có thể ở cấp vendor, cấp gói, cấp lớp hay cấp phương thức. 

4.3. Phương thức  
Tên phương thức phải đặt theo camelCase.

### PSR-4 Autoloading 

1. Bản này mô tả 1 cách cụ thể cho việc tự dộng tải các lớp từ đường dẫn file. Nó tương tác đầy đủ, và có thể dược sử dụng để thêm bất kỳ các chỉ định tự động tải bao gồm cả PSR-0. Bản này cũng mô tả nơi đặt file cái mà sẽ được tự động tải theo sự chỉ định 
2. Chỉ định 
  
  - Từ khóa `class ` tham chiếu tới class, interface, traits. 
  - Một tên lớp tốt đầy đủ có dạng sau: 

     ```php 
     \<NamespaceName>(\<SubNamespaceNames>)*\<ClassName>
     ``` 
    
     -  Tên lớp đầy đủ phải có 1 `namspace` cao nhất, cũng có thể biết như `vendor namspace`
     - Tên lớp đầy đủ cũng có thể có 1 hoặc  nhiều `sub-namespace`. 
     - Phải có tên lớp cuối cùng. 
     - Dấu gạch dưới không có ý nghĩa trong bất kỳ đoạn nào của tên lớp tốt. 
     - Các ký tự chữ cái trong tên lớp đủ điều kiện CÓ THỂ là bất kỳ sự kết hợp nào của chữ thường và chữ hoa.
     - Tất cả các tên lớp phải tham chiếu theo kiểu phân biệt chữ hoa chữ thường. 
  
3. Khi tải 1 tệp tương ứng với tên lớp. .


- Chuỗi liền kề của 1 hoặc nhiều không gian tên và không gian tên đứng đầu, không bao gồm đấu phân tách vùng tên đứng đầu,  trong tên lớp đủ điều kiện ("tiền tố không gian tên") tương ứng với ít nhất một "thư mục cơ sở".
- Chuỗi liền kề không gian tên con sau `tiền tố không gian tên ` tương ứng với 1 thư mục con trong 1 `thư mục cơ sở`, dấu phân tách các không gian tên đại diện cho 1 phân tách thư mục, thư mục con phải 
khớp với tên của không gian tên con 
- Tên lớp đích tương ứng với 1 file có mở rộng là `.php `. Tên file phải khớp với tên của lớp cuối. 
- The terminating class name corresponds to a file name ending in .php. The file name MUST match the case of the terminating class name.


4. Triển khai trình tự động tải không được ném ra ngoại lệ, không đươc sinh ra lõi bất kỳ cấp độ nào và không nên trả về 1 giá trị. 



   
