select i_fac_cd, i_item_cd, i_item_desc  
from t_pm_ms  
where i_com_code = 'NMTH01'  
  and i_fac_cd IN ('01EPT', '1NMTH', '01TP', '02SPK', '03TP', '05LB', '06NH', 'TRD')  
  and i_entry_date >= trunc(trunc(sysdate,'MM')-1,'MM')  
  and i_item_desc NOT LIKE '%CANCEL%'  
  and i_item_cd NOT LIKE 'W-%'  
  and i_item_cd NOT LIKE 'R-%'  
  and i_item_cd IN (  
    select distinct s.i_item_cd  
    from t_ship_aft_tr aft  
    inner join t_ship_tr s on s.i_ship_no = aft.i_ship_no  
    inner join (  
      select *  
      from t_trade_ms  
      where i_com_code = 'NMTH01'  
        and i_dl_desc like '%NITTO%'  
        and i_dl_type in ('02', '05')  
    ) tt on trim(tt.i_dl_cd) = trim(s.i_customer_cd)  
    where s.i_com_code = 'NMTH01'  
      and s.i_so_date >=  to_char(trunc(trunc(sysdate,'MM')-1,'MM'), 'YYYYMMDD')  
      and s.i_fac_cd IN ('01EPT', '1NMTH', '01TP', '02SPK', '03TP', '05LB', '06NH', 'TRD')  
      and trim(aft.I_LOT_NO) NOT IN (  
        select trim(i_frm_lot_no)   
        from T_TRNF_RSLT_TR  
        where i_com_code = 'NMTH01'  
          and i_frm_fac_cd = 'SAM'  
          and i_to_fac_cd IN ('01EPT', '1NMTH', '01TP', '02SPK', '03TP', '05LB', '06NH', 'TRD')  
          and i_frm_stock_mnth >= to_char(trunc(trunc(sysdate,'MM')-1,'MM'), 'YYYYMM')  
      )  
  )  
order by i_fac_cd, i_item_cd