<?php
    //khai báo namespace
    namespace app\core;

    //khai báo composer
    require_once __DIR__ . "/../../vendor/autoload.php";

    //khai báo sử dụng class Exception
    use Exception;

    //khai báo sử dụng class RouteNotFoundException
    use app\core\RouteNotFoundException;

    //khai báo class Route để xử lý định tuyến
    class Route 
    {
        //khai báo thuộc tính routes
        protected array $routes = [];

        //hàm đăng ký route
        public function register(string $route, callable|array $action)
        {
            //thêm route vào mảng routes
            $this->routes[$route] = $action;

            //trả về đối tượng hiện tại để hỗ trợ phương thức chuỗi
            return $this;
        }

        //hàm xử lý định tuyến
        public function resolve(string $requestUrl)
        {
            //tách URL để lấy đường dẫn loại bỏ tham số truy vấn phía sau dấu '?'
            $route = explode('?', $requestUrl)[0];

            //kiểm tra route có tồn tại trong danh sách đã đăng ký không
            $action = $this->routes[$route] ?? null;

            //khai báo mảng tham số
            $params = [];

            //kiểm tra nếu action không tồn tại thì duyệt qua route để tìm regex phù hợp
            if (!$action) {
                // Nếu không khớp chính xác, duyệt qua các route để tìm Regex
                foreach ($this->routes as $path => $callback) {
                    // Chuyển đổi path thành Regex (VD: /product/{id} -> /product/([0-9]+))
                    $pattern = str_replace('/', '\/', $path);
                    $pattern = preg_replace('/\{[a-zA-Z]+\}/', '([a-zA-Z0-9-]+)', $pattern);

                    if (preg_match('/^' . $pattern . '$/', $route, $matches)) {
                        array_shift($matches); // Loại bỏ phần tử đầu tiên (full match)
                        $action = $callback; // Lấy callback tương ứng
                        $params = $matches; // Đây là các tham số như ID, Slug
                        break;
                    }
                }
            }

            //nếu không tìm thấy route, ném ngoại lệ RouteNotFoundException
            if ($action === null) {
                throw new RouteNotFoundException("Route '$route' không tồn tại.");
            }

            //nếu action là callable (hàm ẩn danh), gọi trực tiếp
            if (is_callable($action)) {
                return call_user_func_array($action, $params);
            }

            //nếu action là mảng [ClassName, MethodName], gọi phương thức của lớp tương ứng
            if(is_array($action))
            {
                //lấy tên lớp và tên phương thức
                [$class, $method] = $action;

                //kiểm tra lớp có tồn tại không
                if(class_exists($class))
                {
                    //tạo đối tượng của lớp
                    $class = new $class();

                    //kiểm tra phương thức có tồn tại trong lớp không
                    if(method_exists($class, $method))
                    {
                        //gọi phương thức và trả về kết quả
                        return call_user_func_array([$class, $method], $params);
                    }
                }
            }
            //nếu không thể xử lý, ném ngoại lệ
            throw new Exception("Không thể xử lý route '$route'.");
        }
    }

?>