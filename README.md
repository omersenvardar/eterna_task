Eterna Blog
Eterna Blog, kullanıcıların yazılar oluşturabileceği, okuyabileceği ve blog yazılarına abone olabileceği bir uygulamadır. Bu uygulama, en son gönderilere göz atmayı, detaylı okumayı ve ilgilendikleri gönderilere abone olmayı sağlar.

Özellikler
Kullanıcılar blog yazılarını görüntüleyebilir.
Kullanıcılar yazılara abone olabilir.
Abonelikler için başarı ve hata mesajları SweetAlert2 ile gösterilir.
Dinamik form gösterimi için JavaScript kullanılır.
Teknolojiler
Laravel: PHP framework, backend geliştirme için.
Bootstrap: CSS framework, kullanıcı arayüzü için.
SweetAlert2: Hata ve başarı mesajlarını göstermek için.
JavaScript: Dinamik form gösterimi için.
Kurulum
Gereksinimler
PHP >= 8.3
Composer
Node.js ve npm
MySQL veritabanı
Adımlar
Depoyu Klonlayın: git clone
Gerekli Paketleri Yükleyin: Laravel ve diğer PHP bağımlılıklarını yüklemek için Composer kullanın:
cd eterna-blog
composer install
JavaScript bağımlılıklarını yüklemek için npm kullanın: npm install
Ortam Dosyasını Kopyalayın: .env.example dosyasını .env olarak kopyalayın:
Veritabanı Ayarlarını Yapılandırın: .env dosyasındaki veritabanı ayarlarını kendi veritabanı bilgilerinize göre düzenleyin. Phpmailler için chrome tarayıcınızda bir uygulama şifresi oluşturup o şifreyi .env dosyasında MAIL_PASSWORD kısmına yazın. Aksi takdirde mailler çalışmaz.
Anahtarları ve Veritabanını Kurun: Laravel anahtarını oluşturun ve veritabanı tablolarını kurun: php artisan key:generate
php artisan migrate
JavaScript ve CSS dosyalarını derleyin: npm run dev
Sunucuyu Başlatın:Geliştirme sunucusunu başlatın: php artisan serve
Tarayıcınızda http://localhost:8000 adresine giderek uygulamanızı görüntüleyebilirsiniz.
Kullanım
Ana Sayfa: Blog yazılarını görüntüleyin ve her yazıya abone olun.
Abonelik: Bir yazıya abone olmak için "Abone Ol" butonuna tıklayın. Formu doldurun ve gönderin.
Mesajlar: Başarı ve hata mesajları SweetAlert2 ile gösterilir.


