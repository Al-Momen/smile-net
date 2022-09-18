
####### Procedure #########
CREATE  PROCEDURE PROC_INV_STOCK_PRC_STOCK_IN_MAP (IN_PK_NO Integer)
    NO SQL

	BEGIN

	/*PROC_INV_STOCK_PRC_STOCK_IN_MAP*/
    DECLARE int_F_PRC_STOCK_IN_NO INT(11) default 0;
    DECLARE int_F_INV_WAREHOUSE_NO INT(11) default 0; 
    
	/* INV_WAREHOUSE_NAME variable DECLARE*/
    DECLARE VAR_INV_WAREHOUSE_NAME  varchar(200);

	/*PRC_STOCK_IN_DETAILS*/
    DECLARE int_HAS_DATA_PRC_STOCK_IN_DETAILS INT DEFAULT 1;
    DECLARE int_RECIEVED_QTY INT;
    DECLARE int_FAULTY_QTY INT;
    DECLARE int_TOTAL INT; 
    
	/*INV STOCK*/
	DECLARE xCODE                            INT;
	DECLARE xF_INV_STOCK_PRC_STOCK_IN_MAP_NO INT;
	DECLARE xF_PRC_STOCK_IN_NO               INT;
	DECLARE xF_PRC_STOCK_IN_DETAILS_NO       INT;
	DECLARE xIG_CODE                         varchar(20); 
	DECLARE xSKUID                           varchar(40); 
	DECLARE xF_PRD_VARIANT_NO                INT;
	DECLARE xPRD_VARINAT_NAME                varchar(200); 
	DECLARE xINVOICE_NAME                    varchar(200); 
	DECLARE xF_INV_WAREHOUSE_NO              INT;
	DECLARE xINV_WAREHOUSE_NAME              varchar(200); 
	DECLARE xF_BOOKING_NO                    INT;
	DECLARE xF_BOOKING_DETAILS_NO            INT;
	DECLARE xF_ORDER_NO                      INT;
	DECLARE xF_ORDER_DETAILS_NO              INT;
	DECLARE xHS_CODE                         varchar(20); 
	DECLARE xHS_CODE_NARRATION               varchar(200); 
	DECLARE xF_CATEGORY_NO                   INT;
	DECLARE xCATEGORY_NAME                   varchar(200); 
	DECLARE xF_SUB_CATEGORY_NO               INT;
	DECLARE xSUB_CATEGORY_NAME               varchar(200); 
	DECLARE xBARCODE                         varchar(40); 
	DECLARE xF_BRAND_NO                      INT;
	DECLARE xBRAND_NAME                      varchar(40); 
	DECLARE xF_MODEL_NO                      INT;
	DECLARE xMODEL_NAME                      varchar(200); 
	DECLARE xPRODUCT_STATUS                  INT;
	DECLARE xBOOKING_STATUS                  INT;
	DECLARE xORDER_STATUS                    INT;
	DECLARE xPRODUCT_PURCHASE_PRICE          FLOAT;
	DECLARE xPRD_VARIANT_PRICE               FLOAT;
	DECLARE xORDER_PRICE                     FLOAT;
	DECLARE xF_SHIPPMENT_NO                  INT;
	DECLARE xSHIPMENT_NAME                   varchar(200); 
	DECLARE xBOX_BARCODE                     varchar(200); 
	DECLARE xF_BOX_NO                        INT;
	DECLARE xPRC_IN_IMAGE_PATH               varchar(200); 
	DECLARE xPRD_VARIANT_IMGE_PATH           varchar(200);  


	/*LOOP VARIABLES*/
	DECLARE i int DEFAULT 0;

	DECLARE cur_PRC_STOCK_IN_DETAILS 
    	CURSOR FOR

    		SELECT         
         
				INVOICE.F_PRC_STOCK_IN
				,INVOICE.PK_NO
				,INVOICE.F_PRD_VARIANT_NO
				,PRODUCT.MRK_ID_COMPOSITE_CODE
				,PRODUCT.COMPOSITE_CODE
				,PRODUCT.VARIANT_NAME
				,INVOICE.INVOICE_NAME
				,PRODUCT.HS_CODE
				,PRODUCT.BARCODE
				,INVOICE.UNIT_PRICE_MR_EV
				,INVOICE.RECIEVED_QTY
				,INVOICE.FAULTY_QTY 
				,PRODUCT.REGULAR_PRICE
				/*,PRODUCT.INSTALLMENT_PRICE  */
				,PRODUCT.PRIMARY_IMG_RELATIVE_PATH
				,PRODUCT_MASTER.F_MODEL
				,PRODUCT_MASTER.MODEL_NAME 
				,PRODUCT_MASTER.F_BRAND
				,PRODUCT_MASTER.BRAND_NAME
				,PRODUCT_SUB_CATEGORY.PK_NO
				,PRODUCT_SUB_CATEGORY.`NAME`
				,PRODUCT_CATEGORY.PK_NO
				,PRODUCT_CATEGORY.`NAME`  
                        
              
				FROM 
					PRC_STOCK_IN_DETAILS INVOICE 
					,PRD_VARIANT_SETUP PRODUCT 
					,PRD_MASTER_SETUP PRODUCT_MASTER 
					,PRD_SUB_CATEGORY PRODUCT_SUB_CATEGORY
					,PRD_CATEGORY PRODUCT_CATEGORY
        
        
        		WHERE 
		            INVOICE.F_PRC_STOCK_IN = int_F_PRC_STOCK_IN_NO 
		            AND  INVOICE.F_PRD_VARIANT_NO = PRODUCT.PK_NO
		            AND PRODUCT.F_PRD_MASTER_SETUP_NO=  PRODUCT_MASTER.PK_NO
		            AND PRODUCT_MASTER.F_PRD_SUB_CATEGORY_ID= PRODUCT_SUB_CATEGORY.PK_NO
		            AND PRODUCT_SUB_CATEGORY.F_PRD_CATEGORY_NO=  PRODUCT_CATEGORY.PK_NO
		    		;
            
            
            
	DECLARE CONTINUE HANDLER 
	FOR NOT FOUND SET int_HAS_DATA_PRC_STOCK_IN_DETAILS=0;


	/*delete from R;
	insert into R values ('96');

	insert into R values (int_F_PRC_STOCK_IN_NO);
	insert into R values (int_F_INV_WAREHOUSE_NO);    */


	SELECT F_PRC_STOCK_IN_NO ,F_INV_WAREHOUSE_NO 
		INTO int_F_PRC_STOCK_IN_NO, int_F_INV_WAREHOUSE_NO 
	FROM INV_STOCK_PRC_STOCK_IN_MAP 
	WHERE PK_NO = IN_PK_NO ; 


	/*FOR INV_WAREHOUSE_NAME  */

	SELECT NAME
		INTO VAR_INV_WAREHOUSE_NAME
	FROM INV_WAREHOUSE
	WHERE PK_NO= int_F_INV_WAREHOUSE_NO;


	/*insert into R values (int_F_PRC_STOCK_IN_NO); 
	insert into R values (int_F_INV_WAREHOUSE_NO);        */


	OPEN cur_PRC_STOCK_IN_DETAILS;

		insert into R values ('105');

			get_PRC_STOCK_IN_DETAILS: LOOP

    			FETCH NEXT FROM  cur_PRC_STOCK_IN_DETAILS INTO      


            
             	/*,PRODUCT.INSTALLMENT_PRICE */

             	/*CODE                            ,
				F_INV_STOCK_PRC_STOCK_IN_MAP_NO ,*/
				xF_PRC_STOCK_IN_NO               ,
				xF_PRC_STOCK_IN_DETAILS_NO       ,
				xF_PRD_VARIANT_NO                ,
				xIG_CODE                         ,
				xSKUID                           ,
				xPRD_VARINAT_NAME                , 
				xINVOICE_NAME                    , 
				/*F_INV_WAREHOUSE_NO              ,
				INV_WAREHOUSE_NAME              , 
				F_BOOKING_NO                    ,
				F_BOOKING_DETAILS_NO            ,
				F_ORDER_NO                      ,
				F_ORDER_DETAILS_NO              ,*/
				xHS_CODE                         ,
				xBARCODE                         ,
				xPRODUCT_PURCHASE_PRICE          , 
				int_RECIEVED_QTY                 ,
				int_FAULTY_QTY                   ,
				xPRD_VARIANT_PRICE               ,
				xPRC_IN_IMAGE_PATH               , 
				xF_MODEL_NO                      ,
				xMODEL_NAME                      , 
				xF_BRAND_NO                      ,
				xBRAND_NAME                      , 
				xF_SUB_CATEGORY_NO               ,
				xSUB_CATEGORY_NAME               , 
				xF_CATEGORY_NO                   ,
				xCATEGORY_NAME                   ;

				/*HS_CODE_NARRATION               , */ 
				/* PRODUCT_STATUS                  ,
				BOOKING_STATUS                  ,
				ORDER_STATUS                    ,*/
				/*ORDER_PRICE                     ,
				F_SHIPPMENT_NO                  ,
				SHIPMENT_NAME                   , 
				BOX_BARCODE                     , 
				F_BOX_NO                        ,*/
				/*PRD_VARIANT_IMGE_PATH            */

        

    	/*TOTAL GEN = RECQTY - FAUTLY QTY*/
        IF int_HAS_DATA_PRC_STOCK_IN_DETAILS = 0 THEN 
            LEAVE get_PRC_STOCK_IN_DETAILS;
        	
        END IF;   
        
        SET int_TOTAL = int_RECIEVED_QTY - int_FAULTY_QTY;                                                                                                                  
    
       /* SELECT MRK_ID_COMPOSITE_CODE ;  HS CODE   */  
       
        
        SET i=0;
        WHILE i < int_TOTAL DO
        
              insert into INV_STOCK( 
                 /*CODE                            ,  */
                 F_INV_STOCK_PRC_STOCK_IN_MAP_NO 
                 ,F_PRC_STOCK_IN_NO              
                 ,F_PRC_STOCK_IN_DETAILS_NO       
                 ,IG_CODE                            
                 ,SKUID                            
                 ,F_PRD_VARIANT_NO                
                 ,PRD_VARINAT_NAME                 
                 ,INVOICE_NAME                     
                 ,F_INV_WAREHOUSE_NO                
                 ,INV_WAREHOUSE_NAME               
                 /*,F_BOOKING_NO                    
                 ,F_BOOKING_DETAILS_NO            
                 ,F_ORDER_NO                      
                 ,F_ORDER_DETAILS_NO               */
                 ,HS_CODE                         
               /*,HS_CODE_NARRATION                */
                 ,F_CATEGORY_NO                   
                 ,CATEGORY_NAME                   
                 ,F_SUB_CATEGORY_NO               
                 ,SUB_CATEGORY_NAME                
                 ,BARCODE                                                  
                 ,F_BRAND_NO                      
                 ,BRAND_NAME                      
                 ,F_MODEL_NO                      
                 ,MODEL_NAME                       
        /*       ,PRODUCT_STATUS                  
                 ,BOOKING_STATUS                  
                 ,ORDER_STATUS                    */
                 ,PRODUCT_PURCHASE_PRICE          
                 ,REGULAR_PRICE                   
                 /*,ORDER_PRICE                     
                 ,F_SHIPPMENT_NO                  
                 ,SHIPMENT_NAME                    
                 ,BOX_BARCODE                      
                 ,F_BOX_NO                        */
                 ,PRC_IN_IMAGE_PATH                
                /* PRD_VARIANT_IMGE_PATH      */
                 )
              VALUES              

              ( 
              
                                                       
                IN_PK_NO                           
               ,xF_PRC_STOCK_IN_NO               
               ,xF_PRC_STOCK_IN_DETAILS_NO 
               ,xIG_CODE                         
               ,xSKUID        
               ,xF_PRD_VARIANT_NO                
               ,xPRD_VARINAT_NAME                
               ,xINVOICE_NAME                    
               ,int_F_INV_WAREHOUSE_NO
               ,VAR_INV_WAREHOUSE_NAME           
               ,xHS_CODE                                                   
               ,xF_CATEGORY_NO                   
               ,xCATEGORY_NAME
               ,xF_SUB_CATEGORY_NO               
               ,xSUB_CATEGORY_NAME 
               ,xBARCODE
               ,xF_BRAND_NO                      
               ,xBRAND_NAME 
               ,xF_MODEL_NO                      
               ,xMODEL_NAME                      
               ,xPRODUCT_PURCHASE_PRICE                                           
               ,xPRD_VARIANT_PRICE
               , xPRC_IN_IMAGE_PATH  
               
                 );  
              
              SET i = i + 1;
              
        END WHILE;                        
        

        
    END LOOP get_PRC_STOCK_IN_DETAILS;
    
   
    UPDATE INV_STOCK_PRC_STOCK_IN_MAP
    SET PROCESS_COMPLETE_TIME = NOW()
    WHERE PK_NO=IN_PK_NO;       

    
CLOSE cur_PRC_STOCK_IN_DETAILS;
                        

  /*
if (int_HAS_DATA_PRC_STOCK_IN_DETAILS = 0)
return 

    */

/*insert into INV_STOCK(CODE,INVOICE_NAME,PRD_VARIANT_NAME,HS_CODE,BAR_CODE) 

SELECT CODE,INVOICE_NAME,PRD_VARIANT_NAME,HS_CODE,BAR_CODE 

FROM PRC_STOCK_IN_DETAILS 

WHERE PK_NO = IN_PK_NO;*/

END



########### PROC_SLS_BOOKING ###########
CREATE DEFINER=`ukshop_dev_user`@`%` PROCEDURE `PROC_SLS_BOOKING`(IN_BOOKING_PK_NO Integer, IN_INV_BOOKING_ARRAY VarChar(1024), IN_ROW_COUNT Integer, IN_COL_PARAMETERS Integer, IN_COLUMN_SEPARATOR VarChar(1), IN_ROW_SEPARATOR VarChar(1))
    NO SQL
    BEGIN
        /*10101010,10,5;10101011,9,3;10101012,10,1;*/

        DECLARE int_HAS_cur_PROC_SLS_BOOKING INT DEFAULT 1;
        DECLARE xPK_NO INT;
        DECLARE var_arrary_param1 VARCHAR(100);
        DECLARE var_arrary_param2 VARCHAR(100);
        DECLARE var_arrary_param3 INT;      
        DECLARE var_arrary_row VARCHAR(200); 
        DECLARE var_arrary_row_part VARCHAR(200);     
        DECLARE int_row_count INT;
        DECLARE i,j INT;
  
        DECLARE cur_PROC_SLS_BOOKING
            CURSOR FOR 
                SELECT         
                    PK_NO         
                    FROM INV_STOCK
                    WHERE F_INV_WAREHOUSE_NO=var_arrary_param2 
                    AND (BOOKING_STATUS IS NULL OR BOOKING_STATUS = 0 OR BOOKING_STATUS = 90 ) 
                    AND SKUID=var_arrary_param1 LIMIT var_arrary_param3;  
            
                      
                    DECLARE CONTINUE HANDLER 
                    FOR NOT FOUND SET int_HAS_cur_PROC_SLS_BOOKING = 0;

DELETE FROM R;
INSERT INTO R VALUES('Line 43');
INSERT INTO R VALUES(IN_ROW_COUNT);
                    SET i=1;         
INSERT INTO R VALUES(i);
        
                WHILE i <= IN_ROW_COUNT DO                    
        
                    SELECT substring_index(IN_INV_BOOKING_ARRAY , IN_ROW_SEPARATOR , 1) INTO var_arrary_row;  
insert into R values (IN_INV_BOOKING_ARRAY);
insert into R values (var_arrary_row);

                    SET var_arrary_row_part =  var_arrary_row;      
insert into R values (var_arrary_row_part);

                    SELECT substring_index(var_arrary_row_part , IN_COLUMN_SEPARATOR , 1) INTO var_arrary_param1;
                    SET var_arrary_row_part=substring(var_arrary_row_part , length(var_arrary_param1)+2 , length(var_arrary_row_part) - length(var_arrary_param1) );
                
insert into R values (var_arrary_row_part);

                    SELECT substring_index(var_arrary_row_part,IN_COLUMN_SEPARATOR,1) INTO var_arrary_param2;
                    SET var_arrary_row_part=substring(var_arrary_row_part , length(var_arrary_param2)+2 , length(var_arrary_row_part) - length(var_arrary_param2) ); 
insert into R values (var_arrary_row_part); 
                                                                                                                                                 
                    SET  var_arrary_param3 = var_arrary_row_part;          
INSERT INTO R VALUES('Line 60');

                    SET IN_INV_BOOKING_ARRAY = substring(IN_INV_BOOKING_ARRAY , length(var_arrary_row)+2 , length(IN_INV_BOOKING_ARRAY) - length(var_arrary_row) ); 
INSERT INTO R VALUES('Line 65');
INSERT INTO R VALUES(concat('loop i val ', i));
                    SET int_HAS_cur_PROC_SLS_BOOKING = 1;

                OPEN cur_PROC_SLS_BOOKING;
                    select FOUND_ROWS() into int_row_count ;

insert into R values ('Line 75');  
insert into R values (concat('Found row ', int_row_count));  
insert into R values (var_arrary_row);  
insert into R values (var_arrary_param1);  
insert into R values (var_arrary_param2);  
insert into R values (var_arrary_param3);

                    IF int_row_count  != 0 &&  int_row_count = var_arrary_param3 THEN

                    /*SET j = 0;     
                   
INSERT INTO R VALUES(concat('init j val ', j));*/

                    get_PROC_SLS_BOOKING: LOOP
                        FETCH NEXT FROM  cur_PROC_SLS_BOOKING INTO xPK_NO;
                        IF int_HAS_cur_PROC_SLS_BOOKING = 0 THEN 
                                LEAVE get_PROC_SLS_BOOKING;
                            END IF;
                     
INSERT INTO R VALUES('line 89');
INSERT INTO R VALUES(concat('xPK_NO val ', xPK_NO) );
INSERT INTO R VALUES(concat('j<var_arrary_param3 ', var_arrary_param3) );
/*INSERT INTO R VALUES(concat('loop j val ', j));*/
                       
                        UPDATE INV_STOCK
                            SET F_BOOKING_NO = IN_BOOKING_PK_NO, 
                            BOOKING_STATUS = 10
                            WHERE PK_NO =  xPK_NO;
        
                        insert into SLS_BOOKING_DETAILS(F_BOOKING_NO, F_INV_STOCK_NO) VALUES ( IN_BOOKING_PK_NO, xPK_NO );  
                          /*  SET j = j + 1;*/
                            
                            
                    END LOOP get_PROC_SLS_BOOKING;   
    
                    END IF; 
    
                CLOSE cur_PROC_SLS_BOOKING;  
              
                set i = i + 1;       
        
                END WHILE; 
                               
INSERT INTO R VALUES('122');
                                   
/*SELECT 'success' AS execute_status;*/
 
END
########### END PROC_SLS_BOOKING ###########



