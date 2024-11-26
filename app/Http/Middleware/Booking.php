<?php

namespace App\Http\Middleware;

use Closure;

class Booking
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
        
       if ($request->is('api/booking/jobs')
        || $request->is('api/booking/store')
        || $request->is('api/booking/quest/customer/store')
        || $request->is('api/booking/storetest')
        || $request->is('api/booking/rebookrequest')
        ||  $request->is('api/booking/scalate/index')
        ||  $request->is('api/booking/scalate/create')
        ||  $request->is('api/booking/scalate/threads')
        ||  $request->is('api/booking/appletronics/tracking') ) {
        if (\Auth::user()->hasRole(['Booking Admin User',
                                    'Booking Super User',
                                    'Booking Branch User',
                                    'Booking Promodizer User'
                                     ])) {
            return $next($request);
        } else {
            abort('403');
        }
       }

        //ACCESS JOB UPDATES CAN SENT 
        if ($request->is('api/booking/jobs/jobsupdate') || $request->is('api/booking/jobs/updateserial')) {
                if (\Auth::user()->hasPermissionTo('Jobs Updates')) {
                    return $next($request);
                } else {
                    abort('403');
                }
        
        }  
        //DELETE JOBS
        if ($request->is('api/booking/jobs/trash')) {
            if (\Auth::user()->hasRole(['Booking Admin User',
                                         'Booking Super User' 
             ])) {
                return $next($request);
            } else {
                abort('403');
            }
    
    }  

        //RESTORE
            if ($request->is('api/booking/restore')) {
                if (\Auth::user()->hasPermissionTo('Booking Restore')) {
                    return $next($request);
                } else {
                abort('403');
                }
        
        }

        //RESTORE
        if ($request->is('api/booking/restore/close')) {
                if (\Auth::user()->hasPermissionTo('Booking Restore')) {
                    return $next($request);
                } else {
                abort('403');
                }
        
        } 
        

        //UPDATE
        if ($request->is('api/booking/update')) {
            if (\Auth::user()->hasPermissionTo('Booking Update')) {
                return $next($request);
            } else {
                abort('403');
            }
    
        } 
        //MORE ACCESS
        if ($request->is('api/booking/jobs/salesinvoice/download') || 
            $request->is('api/booking/jobs/checkrecords')||$request->is('api/booking/jobs/additional/download') || $request->is('api/booking/jobs/counts') || $request->is('api/booking/jobs/additional/upload') ) {
            if (\Auth::user()->hasPermissionTo('Api Control')) {
                return $next($request);
            } else {
                abort('403');
            }
    
        } 
        //APPROVE ACCESS
        if ($request->is('api/booking/jobs/action')) {
            if (\Auth::user()->hasPermissionTo('Approved')) {
                return $next($request);
            } else {
                abort('403');
            }
        } 
        //REBOOK ACCESS
        if ($request->is('api/booking/jobs/rebookrequest')) {
            if (\Auth::user()->hasPermissionTo('Rebook Request')) {
                return $next($request);
            } else {
                abort('403');
            }
        } 
        //Cancelled ACCESS
        if ($request->is('api/booking/jobs/cancelled')) {
            if (\Auth::user()->hasPermissionTo('Cancelled Request')) {
                return $next($request);
            } else {
                abort('403');
            }
        } 
    }
}
