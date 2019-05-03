ARCHI_TEMPLATE="/volume1/web/TemplateUserFolder"
ROOT_DIR="/volume1/CM2P_NAS"

num=($(ls /volume1/web/add/reg/ | grep -c .txt))

if [ $num -gt 0 ]
then
	for file in /volume1/web/add/reg/*.txt; do
		echo "Reading : $file ...."
		sed -i 's/\r//' $file
		
		awk 'NR==1' $file | while IFS='|' read -r f1 f2 f3 f4 f5 f6 f7 f8 || [[ -n "$f1" ]]; do
			echo "Creating new user $f3"
			synouser --add $f1 $f2 "$f3" $f4 $f5 $f6
			php /volume1/web/add/mail.php $f5 $f1
		done
		
		END=($(wc -l <$file))
		
		for i in $(seq 2 $((END+1))); do
			awk "NR==$i" $file | while IFS='|' read -r f1 f2 f3 f4  || [[ -n "$f1" ]]; do
				
				echo "Add new user $f1 to group $f2"
				MEMBERS=($(awk -F':' '/'$f2'/{print $4}' /etc/group))
				synogroup --member $f2 ${MEMBERS//,/ } $f1
				echo "Creating directory $f3 into $f4"
				
				IFS=',' read -r -a paths <<< $f4
				for path in "${paths[@]}"
				do
					mkdir "$ROOT_DIR/$path/$f3"
					sudo cp -R $ARCHI_TEMPLATE/* "$ROOT_DIR/$path/$f3/"
					
					
					echo "Changing Ownership and Access Right $ROOT_DIR/$path/$f3/"
					chown -R $f1:$f2 "$ROOT_DIR/$path/$f3/"
					chmod -R 750 "$ROOT_DIR/$path/$f3/"
					
					ls -R "$ROOT_DIR/$path/$f3/" | awk '
						/:$/&&f{s=$0;f=0}
						/:$/&&!f{sub(/:$/,"");s=$0;f=1;next}
						NF&&f{ print s"/"$0 }' | grep Data | xargs -d '\n' chmod -R 700 
				done

			done
		done
		rm $file
	done
else
	echo "No new user file"
fi