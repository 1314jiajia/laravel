<?php

namespace App\Http\Middleware;

use Closure;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 判断session 中是否有值
        if($request->session()->has('adminUser')){
            $nodelist = session('nodelist');
            // 对比数据库中的权限方法/百度去搜
            $actions=explode('\\', \Route::current()->getActionName());
            //或$actions=explode('\\', \Route::currentRouteAction());
            $modelName=$actions[count($actions)-2]=='Controllers'?null:$actions[count($actions)-2];
            $func=explode('@', $actions[count($actions)-1]);
            $controllerName=$func[0];
            $actionName=$func[1];
            
            // 判断方法是否存在
        if(empty($nodelist[$controllerName]) || !in_array($actionName,$nodelist[$controllerName])){

            return redirect('/Admin/index')->with('error','权限不够,需要和管理员睡觉解决!');

        }

             return $next($request);
        
        }else{
            return redirect('/Admin/Login/create');
        }
       
    }
}
