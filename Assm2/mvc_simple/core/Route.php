<?php
    //khai báo namespace
    namespace core;

    //khai báo composer
    require_once __DIR__ . "/../vendor/autoload.php";

    //khai báo sử dụng class Exception

    use Exception;

    //khai báo sử dụng class RouteNotFoundException
    use core\RouteNotFoundException;

    //khai báo class Route để xử lý định tuyến
    class Route 
    {
        //khai báo thuộc tính routes
        protected array $routes = [];

        //hàm đăng ký route
        public function register(string $requestMethod, string $route, callable|array $action)
        {
            //thêm route vào mảng routes
            $this->routes[strtolower($requestMethod)][$route] = $action;

            //trả về đối tượng hiện tại để hỗ trợ phương thức chuỗi
            return $this;
        }


        //tạo hàm get để đăng ký route với phương thức GET
        public function get(string $route, callable|array $action)
        {
            return $this->register('get', $route, $action);
        }


        //tạo hàm post để đăng ký route với phương thức POST
        public function post(string $route, callable|array $action)
        {
            return $this->register('post', $route, $action);
        }


        //hàm xử lý định tuyến
        public function resolve(string $requestUrl, string $requestMethod)
        {
            //loại bỏ chuỗi truy vấn nếu có và chuyển phương thức thành chữ thường
            $route = explode('?', $requestUrl)[0];
            $method = strtolower($requestMethod);

            //kiểm tra xem route có được đăng ký với phương thức hiện tại không
            if(!isset($this->routes[$method])) {
                throw new RouteNotFoundException("Phương thức '$requestMethod' không được hỗ trợ.");
            }

            //lấy danh sách route đã đăng ký cho phương thức hiện tại
            $routesForMethod = $this->routes[$method];
            $action = $routesForMethod[$route] ?? null;

            //khai báo mảng tham số
            $params = [];

            //kiểm tra nếu action không tồn tại thì duyệt qua route để tìm regex phù hợp
            if (!$action) {
                // Nếu không khớp chính xác, duyệt qua các route để tìm Regex
                foreach ($routesForMethod as $path => $callback) {
                    // Chuyển đổi path thành Regex (Từ số thành biểu thức chính quy)
                    $pattern = str_replace('/', '\/', $path);
                    $pattern = preg_replace('/\{[a-zA-Z]+\}/', '([a-zA-Z0-9-]+)', $pattern);

                    // Kiểm tra xem route có khớp với pattern không
                    if (preg_match('/^' . $pattern . '$/', $route, $matches)) {
                        array_shift($matches); // Loại bỏ phần tử đầu tiên
                        $action = $callback; // Lấy callback tương ứng
                        $params = $matches; // Đây là các tham số id
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