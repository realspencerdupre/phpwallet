                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="account-profile.php"><i class="ft-user"></i>Account</a>
                                <div class="dropdown-divider"></div>
                                <?php if ($admin) {?><a class="dropdown-item" href="admin-wallet.php"><i class="ft-lock"></i>Admin</a><?php }?>
                                <a class="dropdown-item" href="index.php"><i class="icon-wallet"></i> My Wallet</a>
                                <div class="dropdown-divider"></div> <a class="dropdown-item" href="logout.php"><i
                                    class="ft-power"></i>
                                <?php echo $lang['WALLET_LOGOUT']; ?></a>
                            </div>